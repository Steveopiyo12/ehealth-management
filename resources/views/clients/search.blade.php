@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search Clients</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Search Filters</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('clients.search') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="keyword" class="form-label">Search Keyword</label>
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Name, ID, Phone, or Email">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">All Genders</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="program" class="form-label">Enrolled Program</label>
                            <select class="form-select" id="program" name="program">
                                <option value="">All Programs</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ request('program') == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Client Results</h6>
            <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-user-plus me-1"></i> Register New Client
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Enrolled Programs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->full_name }}</td>
                            <td>{{ $client->id_number }}</td>
                            <td>{{ ucfirst($client->gender) }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->email ?? 'N/A' }}</td>
                            <td>
                                @forelse($client->enrollments as $enrollment)
                                    <span class="badge bg-primary">{{ $enrollment->program->name }}</span>
                                @empty
                                    <span class="badge bg-secondary">None</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="py-4">
                                    <i class="fas fa-search fa-3x text-gray-300 mb-3"></i>
                                    <p>No clients found. Try adjusting your search criteria or register a new client.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
