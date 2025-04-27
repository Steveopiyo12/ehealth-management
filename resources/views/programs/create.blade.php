@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Health Program</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Program Information</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Program Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter program name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code" class="form-label">Program Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter program code">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label">Program Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter detailed description of the program"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="eligibility" class="form-label">Eligibility Criteria</label>
                    <textarea class="form-control" id="eligibility" name="eligibility" rows="2" placeholder="Enter eligibility criteria"></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacity" class="form-label">Maximum Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Maximum number of clients">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Clear Form</button>
                    <button type="submit" class="btn btn-primary">Create Program</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
