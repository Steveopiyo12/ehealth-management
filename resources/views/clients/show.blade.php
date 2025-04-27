@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Client Profile</h1>
        <div>
            <a href="{{ route('clients.search') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to Search
            </a>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-clipboard-list me-1"></i> Enroll in Program
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Client Basic Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-profile rounded-circle" src="https://via.placeholder.com/150" alt="Client Photo" style="width: 150px; height: 150px;">
                        <h4 class="mt-3">John Doe</h4>
                        <p class="text-muted">ID: 12345678</p>
                        <div class="mt-2">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p><strong><i class="fas fa-venus-mars me-2"></i> Gender:</strong> Male</p>
                        <p><strong><i class="fas fa-birthday-cake me-2"></i> Date of Birth:</strong> 01/01/1980</p>
                        <p><strong><i class="fas fa-phone me-2"></i> Phone:</strong> +254 123 456789</p>
                        <p><strong><i class="fas fa-envelope me-2"></i> Email:</strong> john.doe@example.com</p>
                        <p><strong><i class="fas fa-map-marker-alt me-2"></i> Address:</strong> 123 Health Street, Nairobi</p>
                        <p><strong><i class="fas fa-ambulance me-2"></i> Emergency Contact:</strong> Jane Doe</p>
                        <p><strong><i class="fas fa-phone me-2"></i> Emergency Phone:</strong> +254 987 654321</p>
                    </div>
                </div>
            </div>

            <!-- Medical History Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Medical History</h6>
                    <a href="#" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
                <div class="card-body">
                    <p>Client has a history of hypertension and diabetes type 2. Regular medication includes Metformin and Lisinopril.</p>
                    <p>No known allergies.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Program Enrollments Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Program Enrollments</h6>
                    <a href="{{ route('enrollments.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Enroll in Program
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Enrollment Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Diabetes Management</span>
                                        <div class="small text-muted">Code: DM-2023</div>
                                    </td>
                                    <td>01/01/2023</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Hypertension Control</span>
                                        <div class="small text-muted">Code: HC-2023</div>
                                    </td>
                                    <td>15/02/2023</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Visit History Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Visit History</h6>
                    <a href="#" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Add Visit
                    </a>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">Mar 2023</div>
                                <div class="timeline-item-marker-indicator bg-primary"></div>
                            </div>
                            <div class="timeline-item-content">
                                <p class="fw-bold">Regular Checkup</p>
                                <p>Blood pressure: 130/85, Blood sugar: 120 mg/dL</p>
                                <p>Notes: Client is responding well to medication. Advised to maintain diet and exercise regimen.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">Feb 2023</div>
                                <div class="timeline-item-marker-indicator bg-warning"></div>
                            </div>
                            <div class="timeline-item-content">
                                <p class="fw-bold">Emergency Visit</p>
                                <p>Blood pressure: 160/95, Blood sugar: 200 mg/dL</p>
                                <p>Notes: Client experienced dizziness. Adjusted medication dosage. Follow-up scheduled in 2 weeks.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">Jan 2023</div>
                                <div class="timeline-item-marker-indicator bg-primary"></div>
                            </div>
                            <div class="timeline-item-content">
                                <p class="fw-bold">Initial Assessment</p>
                                <p>Blood pressure: 145/90, Blood sugar: 180 mg/dL</p>
                                <p>Notes: Initial assessment for diabetes and hypertension management. Prescribed Metformin 500mg and Lisinopril 10mg.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom CSS for timeline */
    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0.75rem;
        height: 100%;
        width: 1px;
        background-color: #e3e6f0;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 2rem;
    }
    
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
    .timeline-item-marker {
        position: absolute;
        left: -1.5rem;
    }
    
    .timeline-item-marker-text {
        margin-left: -0.5rem;
        margin-bottom: 0.25rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: #6c757d;
    }
    
    .timeline-item-marker-indicator {
        display: block;
        width: 1rem;
        height: 1rem;
        border-radius: 100%;
        margin-left: -0.25rem;
    }
    
    .timeline-item-content {
        padding-left: 1.5rem;
    }
</style>
@endsection
