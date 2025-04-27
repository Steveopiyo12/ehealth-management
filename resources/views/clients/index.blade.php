@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clients</h1>
        <div>
            <a href="{{ route('program.register.form') }}" class="d-sm-inline-block btn btn-success shadow-sm me-2">
                <i class="fas fa-clipboard-list fa-sm text-white-50 me-1"></i> Enroll Client in Program
            </a>
            <a href="{{ route('clients.create') }}" class="d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-user-plus fa-sm text-white-50 me-1"></i> Register New Client
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Clients</h6>
            <form action="{{ route('clients.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Search clients..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                        @if($clients->count() > 0)
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->full_name }}</td>
                                    <td>{{ $client->id_number }}</td>
                                    <td>{{ ucfirst($client->gender) }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->email ?? 'N/A' }}</td>
                                    <td>
                                        @forelse($client->programs as $program)
                                            <span class="badge bg-primary">{{ $program->name }}</span>
                                        @empty
                                            <span class="text-muted">Not enrolled</span>
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
                                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" {{ $client->enrollments->count() > 0 ? 'disabled' : '' }}>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                                        <p class="mb-1">No clients found</p>
                                        <small class="text-muted">Register your first client to get started</small>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
