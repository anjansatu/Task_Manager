@extends('admin.layouts.master')

@section('admin-content')
<div class="container">
    <h2 class="mb-4">All Deposits</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Deposit Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deposits as $deposit)
                    <tr>
                        <td>{{ $deposit->user->name ?? 'N/A' }}</td>
                        <td><strong>${{ number_format($deposit->amount, 2) }}</strong></td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $deposit->status == 'confirmed' ? 'success' : ($deposit->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($deposit->status) }}
                            </span>
                        </td>
                        <td style="color: rgb(16, 26, 75);">
                            {{ $deposit->created_at->format('F d, Y (h:i A)') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.deposits.show', $deposit->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $deposits->links() }}
    </div>
</div>
@endsection
