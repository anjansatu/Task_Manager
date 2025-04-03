@extends('user.layouts.master')

@section('user-content')
<div class="container">
    <h2 class="mb-4">New Deposit</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('deposits.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Currency Type</label>
                    <select name="currency_type" class="form-control" required id="currency_type">
                        <option value="">Select a currency</option>
                        @foreach($methods as $method)
                            <option value="{{ $method->id }}" data-address="{{ $method->address }}">{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">From address</label>
                    <input type="text" name="from" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">To address</label>
                    <div class="input-group">
                        <select name="to" class="form-control" required id="to">
                            <option value="">Select a currency</option>
                            @foreach($methods as $address)
                                <option value="{{ $address->address }}">
                                    {{ $address->name }} - {{ $address->address }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-outline-secondary" id="copyBtn">Copy</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" step="0.01" placeholder="min deposit $30 " required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Transaction ID</label>
                    <input type="text" name="transaction_id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Submit Deposit</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('copyBtn').addEventListener('click', function() {
        var select = document.getElementById('to');
        var selectedText = select.options[select.selectedIndex].value;

        if (selectedText) {
            navigator.clipboard.writeText(selectedText).then(function() {
                alert('Address copied: ' + selectedText);
            }).catch(function(err) {
                alert('Failed to copy address');
            });
        } else {
            alert('Please select an address first');
        }
    });
</script>

@endsection
