<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Enrollment;
use App\Models\Program;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of program registrations.
     */
    public function registrationsList()
    {
        $enrollments = Enrollment::with(['client', 'program'])->latest()->paginate(10);
        return view('program_registrations.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new program registration.
     */
    public function showRegistrationForm()
    {
        $clients = Client::orderBy('last_name')->get();
        // Retrieve all programs instead of just active ones
        $programs = Program::orderBy('name')->get();
        return view('program_registrations.register', compact('clients', 'programs'));
    }

    /**
     * Store a newly created program registration in storage.
     */
    public function processRegistration(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'program_id' => 'required|exists:programs,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,pending,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        try {
            // Check if client is already enrolled in this program
            $existingEnrollment = Enrollment::where('client_id', $request->client_id)
                ->where('program_id', $request->program_id)
                ->first();

            if ($existingEnrollment) {
                return redirect()->back()
                    ->with('error', 'Client is already registered in this program.')
                    ->withInput();
            }

            // Check if program has available capacity
            $program = Program::findOrFail($request->program_id);
            if ($program->enrolled_count >= $program->capacity) {
                return redirect()->back()
                    ->with('error', 'Program has reached maximum capacity.')
                    ->withInput();
            }

            // Create the enrollment record
            $enrollment = new Enrollment();
            $enrollment->client_id = $validated['client_id'];
            $enrollment->program_id = $validated['program_id'];
            $enrollment->enrollment_date = $validated['enrollment_date'];
            $enrollment->status = $validated['status'];
            $enrollment->notes = $validated['notes'] ?? null;
            $enrollment->save();

            // Redirect to registrations page after successful submission
            return redirect()->route('program.registrations')
                ->with('success', 'Client registered successfully.');
                
        } catch (\Exception $e) {
            // Log the error and return with a user-friendly message
            \Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'There was a problem registering the client. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified program registration.
     */
    public function registrationDetails(Enrollment $enrollment)
    {
        $enrollment->load(['client', 'program']);
        return view('program_registrations.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified program registration.
     */
    public function editRegistration(Enrollment $enrollment)
    {
        $clients = Client::orderBy('last_name')->get();
        $programs = Program::where('status', 'active')->get();
        return view('program_registrations.edit', compact('enrollment', 'clients', 'programs'));
    }

    /**
     * Update the specified program registration in storage.
     */
    public function updateRegistration(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,pending,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $enrollment->update($validated);

        return redirect()->route('program.registrations')
            ->with('success', 'Registration updated successfully.');
    }

    /**
     * Remove the specified program registration from storage.
     */
    public function removeRegistration(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('program.registrations')
            ->with('success', 'Registration deleted successfully.');
    }

    /**
     * Get client information in JSON format.
     */
    public function getClientInfo(Client $client)
    {
        return response()->json([
            'client' => $client
        ]);
    }

    /**
     * Get program information in JSON format.
     */
    public function getProgramInfo(Program $program)
    {
        return response()->json([
            'program' => $program,
            'available_capacity' => $program->available_capacity,
        ]);
    }
}
