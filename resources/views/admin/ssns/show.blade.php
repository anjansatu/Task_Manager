@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h2>SSN Details</h2>
        <a href="{{ route('admin.ssns.index') }}" class="btn btn-secondary mb-3">Back to List</a>

        <div class="card">
            <div class="card-body">
                <h4>{{ $ssn->full_name }}</h4>
                <p><strong>DOB:</strong> {{ $ssn->dob }}</p>
                <p><strong>Address:</strong> {{ $ssn->address }}, {{ $ssn->city }}, {{ $ssn->state }} - {{ $ssn->zip }}</p>
                <p><strong>SSN:</strong> {{ $ssn->ssn }}</p>
                <p><strong>Year:</strong> {{ $ssn->year }}</p>
                <p><strong>Country:</strong> {{ $ssn->country }}</p>

                <a href="{{ route('admin.ssns.edit', $ssn->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('admin.ssns.destroy', $ssn->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
