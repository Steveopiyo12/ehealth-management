@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('program.register.form') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-clipboard-list fa-sm text-white-50 me-1"></i> Enroll Client
        </a>
    </div>
    
    <div class="row">
        <!-- Total Clients Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('clients.index') }}" class="text-decoration-none">
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Clients</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clientCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Active Programs Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('programs.index') }}" class="text-decoration-none">
                <div class="card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Programs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $programCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Enrollments Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('program.registrations') }}" class="text-decoration-none">
                <div class="card border-left-info h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Enrollments
                                </div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $enrollmentCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Activities Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('program.registrations') }}" class="text-decoration-none">
                <div class="card border-left-warning h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Recent Activities</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $recentActivities->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions Card -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-user-plus me-2"></i> Register New Client
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('program.register.form') }}" class="btn btn-success btn-block">
                                <i class="fas fa-clipboard-list me-2"></i> Enroll Client
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('programs.create') }}" class="btn btn-info btn-block text-white">
                                <i class="fas fa-plus-circle me-2"></i> Create Program
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('clients.search') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-search me-2"></i> Search Client
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Clients Card -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Clients</h6>
                </div>
                <div class="card-body">
                    @if($recentClients->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($recentClients as $client)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $client->full_name }}</strong>
                                        <div class="small text-muted">ID: {{ $client->id_number }}</div>
                                    </div>
                                    <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">
                            No clients registered yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
