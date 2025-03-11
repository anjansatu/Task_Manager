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
                    <select name="currency_type" class="form-control" required>
                        <option value="" disabled selected>Select Currency</option>
                        <option value="USD">USD - US Dollar</option>
                        <option value="EUR">EUR - Euro</option>
                        <option value="BDT">BDT - Bangladeshi Taka</option>
                        <option value="GBP">GBP - British Pound</option>
                        <option value="INR">INR - Indian Rupee</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">From address</label>
                    <input type="text" name="from" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">To address</label>
                    <select name="to" class="form-control" required>
                        <option value="">Select an address</option>
                        <option value="bc1q9p4wmfuksjp5fwpquclaxkvad5d7uvrqqyjlvv">bc1q9p4wmfuksjp5fwpquclaxkvad5d7uvrqqyjlvv</option>
                        <option value="bc1q9p4wmfuksjp5fwpquclaxkvad5d7uvrqqyjlvv">bc1q9p4wmfuksjp5fwpquclaxkvad5d7uvrqqyjlvv</option>
                        <option value="bc1q9p4wmfuksjp5fwpquclaxkvad5d7uvrqqyjlvv">bc1q9p4wmfuksjp5fwpquclaxkvad5d7uvrqqyjlvv</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" step="0.01" required>
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
@endsection
