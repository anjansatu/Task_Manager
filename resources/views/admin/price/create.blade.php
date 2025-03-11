@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h2>Create Admin</h2>
        <form action="{{ route('admin.price.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
