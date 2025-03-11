@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <h1>Deposit Methods</h1>

        <!-- Flash message for success -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Deposit Method Form -->
        <form action="{{ route('admin.deposits.storeDepositMethods') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Method Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Deposit Method</button>
        </form>

        <hr>

        <!-- Existing Deposit Methods List -->
        <h3>Existing Deposit Methods</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($methods as $method)
                    <tr>
                        <td>{{ $method->name }}</td>
                        <td>{{ $method->address }}</td>
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.deposits.destroyDepositMethods', $method->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
