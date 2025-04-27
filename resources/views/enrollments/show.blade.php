@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Enrollment Details</h1>
        <div>
            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to Enrollments
            </a>
            <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit me-1"></i> Edit Enrollment
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <!-- Client Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-profile rounded-circle" src="https://via.placeholder.com/150" alt="Client Photo" style="width: 100px; height: 100px;">
                        <h4 class="mt-3">{{ $enrollment->client->full_name }}</h4>
                        <p class="text-muted">ID: {{ $enrollment->client->id_number }}</p>
                        <div class="mt-2">
                            <a href="{{ route('clients.show', $enrollment->client) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye me-1"></i> View Full Profile
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p><strong><i class="fas fa-venus-mars me-2"></i> Gender:</strong> {{ ucfirst($enrollment->client->gender) }}</p>
                        <p><strong><i class="fas fa-birthday-cake me-2"></i> Date of Birth:</strong> {{ $enrollment->client->date_of_birth->format('Y-m-d') }}</p>
                        <p><strong><i class="fas fa-phone me-2"></i> Phone:</strong> {{ $enrollment->client->phone }}</p>
                        <p><strong><i class="fas fa-envelope me-2"></i> Email:</strong> {{ $enrollment->client->email ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Program Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Program Information</h6>
                </div>
                <div class="card-body">
                    <h4>{{ $enrollment->program->name }}</h4>
                    <p class="text-muted">Code: {{ $enrollment->program->code }}</p>
                    
                    <div class="mb-3">
                        <p><strong>Status:</strong> 
                            @if($enrollment->program->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($enrollment->program->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($enrollment->program->status == 'completed')
                                <span class="badge bg-secondary">Completed</span>
                            @endif
                        </p>
                        <p><strong>Start Date:</strong> {{ $enrollment->program->start_date->format('Y-m-d') }}</p>
                        <p><strong>End Date:</strong> {{ $enrollment->program->end_date ? $enrollment->program->end_date->format('Y-m-d') : 'N/A' }}</p>
                        <p>
                            <strong>Capacity:</strong> 
                            {{ $enrollment->program->enrolled_count }} / {{ $enrollment->program->capacity }}
                            <div class="progress mt-1" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" 
                                    style="width: {{ ($enrollment->program->enrolled_count / $enrollment->program->capacity) * 100 }}%" 
                                    aria-valuenow="{{ $enrollment->program->enrolled_count }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="{{ $enrollment->program->capacity }}">
                                </div>
                            </div>
                        </p>
                    </div>
                    
                    <hr>
                    
                    <h6 class="font-weight-bold">Description</h6>
                    <p>{{ $enrollment->program->description }}</p>
                    
                    @if($enrollment->program->eligibility)
                        <h6 class="font-weight-bold">Eligibility Criteria</h6>
                        <p>{{ $enrollment->program->eligibility }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrollment Details</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Enrollment ID:</strong> {{ $enrollment->id }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Enrollment Date:</strong> {{ $enrollment->enrollment_date->format('Y-m-d') }}</p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Status:</strong> 
                        @if($enrollment->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($enrollment->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($enrollment->status == 'completed')
                            <span class="badge bg-secondary">Completed</span>
                        @elseif($enrollment->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </p>
                </div>
            </div>
            
            @if($enrollment->notes)
                <div class="mt-3">
                    <h6 class="font-weight-bold">Enrollment Notes</h6>
                    <div class="card bg-light">
                        <div class="card-body">
                            {{ $enrollment->notes }}
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="mt-4 text-end">
                <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete Enrollment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
