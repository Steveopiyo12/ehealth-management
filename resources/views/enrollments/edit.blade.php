@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Enrollment</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrollment Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_name" class="form-label">Client</label>
                            <input type="text" class="form-control" id="client_name" value="{{ $enrollment->client->full_name }}" disabled>
                            <input type="hidden" name="client_id" value="{{ $enrollment->client_id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="program_name" class="form-label">Program</label>
                            <input type="text" class="form-control" id="program_name" value="{{ $enrollment->program->name }}" disabled>
                            <input type="hidden" name="program_id" value="{{ $enrollment->program_id }}">
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="enrollment_date" class="form-label">Enrollment Date</label>
                            <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" value="{{ $enrollment->enrollment_date->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="form-label">Enrollment Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" {{ $enrollment->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ $enrollment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $enrollment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="notes" class="form-label">Enrollment Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any notes about this enrollment">{{ $enrollment->notes }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Enrollment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
