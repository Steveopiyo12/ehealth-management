<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }

    public function search()
    {
        return view('clients.search');
    }

    public function show($client)
    {
        // In a real app, you would fetch the client data here
        return view('clients.show', ['clientId' => $client]);
    }
}
