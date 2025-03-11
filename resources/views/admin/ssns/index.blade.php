@extends('admin.layouts.master')

@section('admin-content')
<div class="container">
    <form method="GET" action="{{ route('admin.ssns.index') }}">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search SSN" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <div class="row justify-content-end">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">{{ __('Import Excel File') }}</div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.excel.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="xlsxFile">Upload Excel File</label>
                            <input type="file" class="form-control @error('xlsxFile') is-invalid @enderror" name="xlsxFile" required>
                            @error('xlsxFile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2>SSN List</h2>
    <a href="{{ route('admin.ssns.create') }}" class="btn btn-primary">Add SSN</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>DOB</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>SSN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ssns as $ssn)
                <tr>
                    <td>{{ $ssn->full_name }}</td>
                    <td>{{ $ssn->dob }}</td>
                    <td>{{ $ssn->address }}</td>
                    <td>{{ $ssn->city }}</td>
                    <td>{{ $ssn->state }}</td>
                    <td>{{ $ssn->ssn }}</td>
                    <td>
                        <a href="{{ route('admin.ssns.show', $ssn->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.ssns.edit', $ssn->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.ssns.destroy', $ssn->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $ssns->appends(request()->query())->links() }}
    </div>
</div>
@endsection
