@extends('admin.layouts.master')

@section('admin-content')
<div class="container">
    <h2 class="mb-4">Deposit Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $deposit->id }}</p>
            <p><strong>User:</strong> {{ $deposit->user->name ?? 'N/A' }}</p>
            <p><strong>Amount:</strong> ${{ number_format($deposit->amount, 2) }}</p>
            <p><strong>Status:</strong>
                <span class="badge bg-{{ $deposit->status == 'confirmed' ? 'success' : ($deposit->status == 'pending' ? 'warning' : 'danger') }}">
                    {{ ucfirst($deposit->status) }}
                </span>
            </p>
            <p><strong>Created At:</strong> {{ $deposit->created_at->format('Y-m-d H:i') }}</p>

            <form action="{{ route('admin.deposits.updateStatus', $deposit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label">Update Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $deposit->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="failed" {{ $deposit->status == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Status</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.deposits.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
