@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Donate to: {{ $petition->title }}</h3>
    <form action="{{ route('donations.store', $petition->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-select">
                <option value="">Select…</option>
                <option value="paypal">PayPal</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit donation</button>
    </form>
</div>
@endsection
