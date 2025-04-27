<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display the specified client resource as JSON.
     */
    public function show(Client $client)
    {
        // Load client's programs via enrollments
        $client->load('enrollments.program');
        
        // Format the response
        $response = [
            'id' => $client->id,
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'full_name' => $client->full_name,
            'id_number' => $client->id_number,
            'gender' => $client->gender,
            'date_of_birth' => $client->date_of_birth->format('Y-m-d'),
            'phone' => $client->phone,
            'email' => $client->email,
            'address' => $client->address,
            'city' => $client->city,
            'state' => $client->state,
            'postal_code' => $client->postal_code,
            'emergency_contact' => $client->emergency_contact,
            'emergency_phone' => $client->emergency_phone,
            'medical_history' => $client->medical_history,
            'enrollments' => $client->enrollments->map(function($enrollment) {
                return [
                    'id' => $enrollment->id,
                    'program' => [
                        'id' => $enrollment->program->id,
                        'name' => $enrollment->program->name,
                        'code' => $enrollment->program->code,
                        'status' => $enrollment->program->status,
                    ],
                    'enrollment_date' => $enrollment->enrollment_date->format('Y-m-d'),
                    'status' => $enrollment->status,
                    'notes' => $enrollment->notes,
                ];
            }),
            'created_at' => $client->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $client->updated_at->format('Y-m-d H:i:s'),
        ];
        
        return response()->json($response);
    }
}
