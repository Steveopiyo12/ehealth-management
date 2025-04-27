@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Enroll Client into Program</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrollment Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('program.register.process') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_id" class="form-label">Select Client</label>
                            <select class="form-select" id="client_id" name="client_id">
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->full_name }} ({{ $client->id_number }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="program_id" class="form-label">Select Program</label>
                            <select class="form-select" id="program_id" name="program_id">
                                <option value="">Select Program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }} (Code: {{ $program->code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="m-0">Client Information Preview</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" id="client-info-placeholder">
                            Select a client to view their information
                        </div>
                        <div id="client-info" class="d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> <span id="client-name">-</span></p>
                                    <p><strong>ID Number:</strong> <span id="client-id-number">-</span></p>
                                    <p><strong>Gender:</strong> <span id="client-gender">-</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date of Birth:</strong> <span id="client-dob">-</span></p>
                                    <p><strong>Phone:</strong> <span id="client-phone">-</span></p>
                                    <p><strong>Email:</strong> <span id="client-email">-</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="m-0">Program Information Preview</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" id="program-info-placeholder">
                            Select a program to view its information
                        </div>
                        <div id="program-info" class="d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> <span id="program-name">-</span></p>
                                    <p><strong>Code:</strong> <span id="program-code">-</span></p>
                                    <p><strong>Status:</strong> <span id="program-status">-</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Start Date:</strong> <span id="program-start-date">-</span></p>
                                    <p><strong>End Date:</strong> <span id="program-end-date">-</span></p>
                                    <p><strong>Available Capacity:</strong> <span id="program-capacity">-</span></p>
                                </div>
                            </div>
                            <p><strong>Description:</strong> <span id="program-description">-</span></p>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="enrollment_date" class="form-label">Enrollment Date</label>
                            <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="form-label">Enrollment Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="notes" class="form-label">Enrollment Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any notes about this enrollment"></textarea>
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Clear Form</button>
                    <button type="submit" class="btn btn-primary">Complete Enrollment</button>
                </div>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const clientSelect = document.getElementById('client_id');
                    const programSelect = document.getElementById('program_id');
                    
                    const clientInfoPlaceholder = document.getElementById('client-info-placeholder');
                    const clientInfo = document.getElementById('client-info');
                    const programInfoPlaceholder = document.getElementById('program-info-placeholder');
                    const programInfo = document.getElementById('program-info');
                    
                    // Client selection change handler
                    clientSelect.addEventListener('change', function() {
                        const clientId = this.value;
                        
                        if (clientId) {
                            // Fetch client info via AJAX
                            fetch(`/api/clients/${clientId}/info`)
                                .then(response => response.json())
                                .then(data => {
                                    // Update client preview
                                    document.getElementById('client-name').textContent = data.client.first_name + ' ' + data.client.last_name;
                                    document.getElementById('client-id-number').textContent = data.client.id_number;
                                    document.getElementById('client-gender').textContent = data.client.gender;
                                    document.getElementById('client-dob').textContent = data.client.date_of_birth;
                                    document.getElementById('client-phone').textContent = data.client.phone;
                                    document.getElementById('client-email').textContent = data.client.email || 'N/A';
                                    
                                    // Show client info, hide placeholder
                                    clientInfoPlaceholder.classList.add('d-none');
                                    clientInfo.classList.remove('d-none');
                                });
                        } else {
                            // Hide client info, show placeholder
                            clientInfoPlaceholder.classList.remove('d-none');
                            clientInfo.classList.add('d-none');
                        }
                    });
                    
                    // Program selection change handler
                    programSelect.addEventListener('change', function() {
                        const programId = this.value;
                        
                        if (programId) {
                            // Fetch program info via AJAX
                            fetch(`/api/programs/${programId}/info`)
                                .then(response => response.json())
                                .then(data => {
                                    // Update program preview
                                    document.getElementById('program-name').textContent = data.program.name;
                                    document.getElementById('program-code').textContent = data.program.code;
                                    document.getElementById('program-status').textContent = data.program.status;
                                    document.getElementById('program-start-date').textContent = data.program.start_date;
                                    document.getElementById('program-end-date').textContent = data.program.end_date || 'N/A';
                                    document.getElementById('program-capacity').textContent = data.available_capacity + ' of ' + data.program.capacity;
                                    document.getElementById('program-description').textContent = data.program.description;
                                    
                                    // Show program info, hide placeholder
                                    programInfoPlaceholder.classList.add('d-none');
                                    programInfo.classList.remove('d-none');
                                });
                        } else {
                            // Hide program info, show placeholder
                            programInfoPlaceholder.classList.remove('d-none');
                            programInfo.classList.add('d-none');
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection
