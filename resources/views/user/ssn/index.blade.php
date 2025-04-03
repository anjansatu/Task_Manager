@extends('user.layouts.master')

@section('user-content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">SSN List</h2>
        <form method="GET" action="{{ route('user.ssn.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>
    </div>

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
                        <th>State</th>
                        <th>Country</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ssns as $ssn)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ssn->first_name }}</td>
                            <td>{{ $ssn->last_name }}</td>
                            <td>{{ $ssn->state }}</td>
                            <td>{{ $ssn->country }}</td>
                            <td>{{ $ssn->year }}</td>
                            <td>
                                @if($ssn->price)
                                    <span class="fw-bold text-success">${{ number_format($ssn->price->amount, 2) }}</span>
                                @else
                                    <span class="text-muted">$0.50</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary buy-btn" data-id="{{ $ssn->id }}">
                                    <i class="fas fa-shopping-cart"></i> Buy
                                </button>
                            </td>
                        </tr>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        $('.buy-btn').click(function(e) {
            e.preventDefault();

            let button = $(this);
            let ssnId = button.data('id');

            $.ajax({
                url: "{{ route('ssn.storeOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ssn_id: ssnId
                },
                success: function(response) {
                    if (response.success) {
                        button.prop('disabled', true);
                        button.removeClass('btn-primary').addClass('btn-success');
                        button.html('<i class="fas fa-check"></i>'); // Checkmark icon instead of text

                        // Reload the page after success
                        location.reload();
                    } else {
                        alert("Failed to process the order.");
                    }
                },
                error: function(xhr) {
                    alert("Error: " + xhr.responseJSON.message);
                }
            });
        });
    });
</script>


@endsection
