@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Enrollment Details</h1>
        <div>
            <a href="{{ route('program.registration.edit', $enrollment) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit Enrollment
            </a>
            <a href="{{ route('program.registrations') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Client Information</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $enrollment->client->last_name }}, {{ $enrollment->client->first_name }}
                            </div>
                            <div class="mt-2">
                                <p class="mb-1"><strong>Email:</strong> {{ $enrollment->client->email }}</p>
                                <p class="mb-1"><strong>Phone:</strong> {{ $enrollment->client->phone }}</p>
                                <p class="mb-0"><strong>ID Number:</strong> {{ $enrollment->client->id_number }}</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Program Information</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrollment->program->name }}</div>
                            <div class="mt-2">
                                <p class="mb-1"><strong>Description:</strong> {{ Str::limit($enrollment->program->description, 100) }}</p>
                                <p class="mb-1"><strong>Duration:</strong> {{ $enrollment->program->duration }} weeks</p>
                                <p class="mb-0"><strong>Capacity:</strong> {{ $enrollment->program->enrolled_count }}/{{ $enrollment->program->capacity }}</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Enrollment Status</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($enrollment->status == 'active')
                                    <span class="badge bg-success text-white">Active</span>
                                @elseif($enrollment->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($enrollment->status == 'completed')
                                    <span class="badge bg-info text-white">Completed</span>
                                @else
                                    <span class="badge bg-danger text-white">Cancelled</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <p class="mb-1"><strong>Enrollment Date:</strong> {{ $enrollment->enrollment_date->format('Y-m-d') }}</p>
                                <p class="mb-1"><strong>Created:</strong> {{ $enrollment->created_at->format('Y-m-d H:i') }}</p>
                                <p class="mb-0"><strong>Last Updated:</strong> {{ $enrollment->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
                </div>
                <div class="card-body">
                    @if($enrollment->notes)
                        {{ $enrollment->notes }}
                    @else
                        <em>No notes available</em>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Enrollment Management</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('program.registration.delete', $enrollment) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this enrollment? This action cannot be undone.')">
                            <i class="fas fa-trash fa-sm text-white-50"></i> Delete Enrollment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
