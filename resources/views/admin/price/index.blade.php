@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h2>Admin List</h2>
        <a href="{{ route('admin.price.create') }}" class="btn btn-primary">Create Admin</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach($price as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->price }}</td>
                    <td>{{ $admin->status }}</td>
                    <td>
                        <a href="{{ route('admin.price.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.price.destroy', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
