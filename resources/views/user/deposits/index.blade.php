@extends('user.layouts.master')

@section('user-content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Deposits</h2>
        <a href="{{ route('deposits.create') }}" class="btn btn-primary">New Deposit</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive"> <!-- Added responsive wrapper -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Currency</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Transaction ID</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $key => $deposit)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $deposit->currency_type }}</td>
                                <td>{{ $deposit->from }}</td>
                                <td>{{ $deposit->to }}</td>
                                <td>${{ number_format($deposit->amount, 2) }}</td>
                                <td>{{ $deposit->transaction_id }}</td>
                                <td>
                                    <span class="badge bg-{{ $deposit->status === 'pending' ? 'warning' : 'success' }}">
                                        {{ ucfirst($deposit->status) }}
                                    </span>
                                </td>
                                <td>{{ $deposit->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- End responsive wrapper -->
        </div>
    </div>
</div>
@endsection
