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
            <form action="#" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_id" class="form-label">Select Client</label>
                            <select class="form-select" id="client_id" name="client_id">
                                <option value="">Select Client</option>
                                <!-- Client options will be populated from database -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="program_id" class="form-label">Select Program</label>
                            <select class="form-select" id="program_id" name="program_id">
                                <option value="">Select Program</option>
                                <!-- Program options will be populated from database -->
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
        </div>
    </div>
</div>
@endsection
