@extends('layouts.app')

@section('styles')
<style>
    .healthcare-gradient {
        background: linear-gradient(135deg, #1cc88a 0%, #36b9cc 100%);
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 7px 15px rgba(0, 0, 0, 0.1);
    }
    .stat-card .icon-circle {
        height: 60px;
        width: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .stat-card .icon-circle i {
        font-size: 1.8rem;
        color: white;
    }
    .stat-card .card-title {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
    }
    .stat-card .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
    }
    .btn-action {
        border-radius: 50px;
        padding: 8px 20px;
        margin: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .table-actions .btn {
        border-radius: 50%;
        width: 35px;
        height: 35px;
        line-height: 20px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 3px;
    }
    .status-badge {
        padding: 7px 15px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .card-header {
        background-color: white;
        border-bottom: none;
    }
    .card-header h6 {
        color: #1e88e5;
        letter-spacing: 0.05rem;
    }
    .nav-metrics {
        border-bottom: none;
    }
    .nav-metrics .nav-link {
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-right: 10px;
        color: #495057;
        font-weight: 600;
    }
    .nav-metrics .nav-link.active {
        background-color: #e3f2fd;
        color: #1e88e5;
    }
    .activity-item {
        border-left: 2px solid #e9ecef;
        padding: 0 0 15px 20px;
        position: relative;
    }
    .activity-item::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 0;
        width: 15px;
        height: 15px;
        border-radius: 50%;
    }
    .activity-item.active::before {
        background-color: #1cc88a;
    }
    .activity-item.pending::before {
        background-color: #f6c23e;
    }
    .activity-item.completed::before {
        background-color: #4e73df;
    }
    .activity-item.cancelled::before {
        background-color: #e74a3b;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #36b9cc 0%, #1cc88a 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        color: white;
    }
    .welcome-banner h2 {
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1.75rem;
    }
    .welcome-banner p {
        opacity: 0.9;
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="welcome-banner shadow">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2>Welcome to eHealth Management</h2>
                <p>{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.logout') }}" class="btn btn-light btn-sm px-3 py-2">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Clients Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 h-100 stat-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                            <div class="icon-circle rounded-circle healthcare-gradient">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col pl-4">
                            <div class="card-title text-muted">Total Clients</div>
                            <div class="stat-value">{{ $clientCount }}</div>
                            <div class="mt-2">
                                <a href="{{ route('clients.index') }}" class="text-primary small">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programs Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 h-100 stat-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                            <div class="icon-circle rounded-circle healthcare-gradient">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                        <div class="col pl-4">
                            <div class="card-title text-muted">Health Programs</div>
                            <div class="stat-value">{{ $programCount }}</div>
                            <div class="mt-2">
                                <a href="{{ route('programs.index') }}" class="text-primary small">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 h-100 stat-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                            <div class="icon-circle rounded-circle healthcare-gradient">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>
                        <div class="col pl-4">
                            <div class="card-title text-muted">Total Enrollments</div>
                            <div class="stat-value">{{ $enrollmentCount }}</div>
                            <div class="mt-2">
                                <a href="{{ route('program.registrations') }}" class="text-primary small">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="card shadow mb-4 border-0">
        <div class="card-header bg-white py-3">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Patient Activities</h6>
                <a href="{{ route('program.registrations') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                    View All Activities
                </a>
            </div>
            
            <ul class="nav nav-metrics mt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Active</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Enrollment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivities as $activity)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img/undraw_profile.svg') }}" alt="Patient" width="35" height="35" class="rounded-circle mr-2">
                                        <div>
                                            <a href="{{ route('clients.show', $activity->client) }}" class="text-primary font-weight-bold">{{ $activity->client->full_name }}</a>
                                            <div class="text-muted small">ID: {{ $activity->client->id_number }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-nowrap">{{ $activity->program->name }}</span>
                                </td>
                                <td>
                                    @if($activity->status == 'active')
                                        <span class="status-badge bg-success text-white">Active</span>
                                    @elseif($activity->status == 'pending')
                                        <span class="status-badge bg-warning text-dark">Pending</span>
                                    @elseif($activity->status == 'completed')
                                        <span class="status-badge bg-info text-white">Completed</span>
                                    @else
                                        <span class="status-badge bg-danger text-white">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-nowrap">{{ \Carbon\Carbon::parse($activity->enrollment_date)->format('M d, Y') }}</span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ route('program.registration.details', $activity) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('program.registration.edit', $activity) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <img src="{{ asset('img/undraw_empty.svg') }}" alt="No Data" style="width: 100px; opacity: 0.5" class="mb-3">
                                    <p class="text-muted">No recent activities found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Action Cards -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Patient Management</h6>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <h5 class="text-dark font-weight-bold">Patient Administration</h5>
                                <p class="text-muted mb-0">Manage patient records and healthcare information</p>
                            </div>
                            <img src="{{ asset('img/undraw_profile_details.svg') }}" alt="Patients" style="width: 70px; opacity: 0.8">
                        </div>
                        
                        <div class="mt-4 d-flex flex-wrap">
                            <a href="{{ route('clients.index') }}" class="btn btn-outline-primary btn-action mr-2 mb-2">
                                <i class="fas fa-users mr-2"></i> All Patients
                            </a>
                            <a href="{{ route('clients.create') }}" class="btn btn-outline-success btn-action mr-2 mb-2">
                                <i class="fas fa-user-plus mr-2"></i> Register Patient
                            </a>
                            <a href="{{ route('clients.search') }}" class="btn btn-outline-info btn-action mb-2">
                                <i class="fas fa-search mr-2"></i> Find Patient
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Medical Program Management</h6>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <h5 class="text-dark font-weight-bold">Healthcare Programs</h5>
                                <p class="text-muted mb-0">Manage treatment programs and patient enrollment</p>
                            </div>
                            <img src="{{ asset('img/undraw_medicine_b1ol.svg') }}" alt="Programs" style="width: 70px; opacity: 0.8">
                        </div>
                        
                        <div class="mt-4 d-flex flex-wrap">
                            <a href="{{ route('programs.index') }}" class="btn btn-outline-primary btn-action mr-2 mb-2">
                                <i class="fas fa-clipboard-list mr-2"></i> All Programs
                            </a>
                            <a href="{{ route('programs.create') }}" class="btn btn-outline-success btn-action mr-2 mb-2">
                                <i class="fas fa-plus mr-2"></i> New Program
                            </a>
                            <a href="{{ route('program.register.form') }}" class="btn btn-outline-warning btn-action mb-2">
                                <i class="fas fa-clipboard-check mr-2"></i> Enroll Patient
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
