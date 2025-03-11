@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h2>Edit Admin</h2>
        <form action="{{ route('admin.price.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $admin->price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ $admin->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $admin->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
