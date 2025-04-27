<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the programs.
     */
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('programs.index', compact('programs'));
    }
    
    /**
     * Show the form for creating a new program.
     */
    public function create()
    {
        return view('programs.create');
    }
    
    /**
     * Store a newly created program in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:programs',
            'description' => 'required|string',
            'eligibility' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,pending,completed',
        ]);
        
        Program::create($validated);
        
        return redirect()->route('programs.index')
            ->with('success', 'Program created successfully.');
    }
    
    /**
     * Display the specified program.
     */
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }
    
    /**
     * Show the form for editing the specified program.
     */
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }
    
    /**
     * Update the specified program in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:programs,code,' . $program->id,
            'description' => 'required|string',
            'eligibility' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,pending,completed',
        ]);
        
        $program->update($validated);
        
        return redirect()->route('programs.index')
            ->with('success', 'Program updated successfully.');
    }
    
    /**
     * Remove the specified program from storage.
     */
    public function destroy(Program $program)
    {
        // Check if program has enrollments before deleting
        if ($program->enrollments()->count() > 0) {
            return redirect()->route('programs.index')
                ->with('error', 'Cannot delete program with active enrollments.');
        }
        
        $program->delete();
        
        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
