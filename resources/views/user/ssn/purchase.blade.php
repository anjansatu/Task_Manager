@extends('user.layouts.master')

@section('user-content')

<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($ssns->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>ZIP</th>
                        <th>SSN</th>
                        <th>DOB</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ssns as $order)
                        @foreach($order->orderHistory as $history)
                            <tr>
                                <td>{{ $loop->parent->iteration }}</td>
                                <td>{{ $history->first_name }}</td>
                                <td>{{ $history->last_name }}</td>
                                <td>{{ $history->address }}</td>
                                <td>{{ $history->city }}</td>
                                <td>{{ $history->state }}</td>
                                <td>{{ $history->zip }}</td>
                                <td>{{ $history->ssn }}</td>
                                <td>{{ $history->dob }}</td>
                                <td>{{ $history->country }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $ssns->appends(request()->query())->links() }}
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-circle"></i> No SSN records found.
        </div>
    @endif
</div>

@endsection
