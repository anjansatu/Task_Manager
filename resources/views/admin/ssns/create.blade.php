@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h2>Add SSN</h2>
        <form action="{{ route('admin.ssns.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>DOB</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label>State</label>
                <input type="text" name="state" class="form-control" required>
            </div>
            <div class="form-group">
                <label>ZIP</label>
                <input type="text" name="zip" class="form-control" required>
            </div>
            <div class="form-group">
                <label>SSN</label>
                <input type="text" name="ssn" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
