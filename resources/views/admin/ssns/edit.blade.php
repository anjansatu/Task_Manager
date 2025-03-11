@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h2>Edit SSN</h2>
        <a href="{{ route('admin.ssns.index') }}" class="btn btn-secondary mb-3">Back to List</a>

        <form action="{{ route('admin.ssns.update', $ssn->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $ssn->first_name }}" required>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $ssn->last_name }}" required>
            </div>

            <div class="form-group">
                <label>DOB</label>
                <input type="date" name="dob" class="form-control" value="{{ $ssn->dob }}" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ $ssn->address }}" required>
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="{{ $ssn->city }}" required>
            </div>

            <div class="form-group">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="{{ $ssn->state }}" required>
            </div>

            <div class="form-group">
                <label>ZIP</label>
                <input type="text" name="zip" class="form-control" value="{{ $ssn->zip }}" required>
            </div>

            <div class="form-group">
                <label>SSN</label>
                <input type="text" name="ssn" class="form-control" value="{{ $ssn->ssn }}" required>
            </div>

            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" class="form-control" value="{{ $ssn->year }}" required>
            </div>

            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" value="{{ $ssn->country }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
