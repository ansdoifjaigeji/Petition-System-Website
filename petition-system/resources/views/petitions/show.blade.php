@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Petition details -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $petition->title }}</h2>
        <p class="text-gray-600 mb-4">{{ $petition->description }}</p>

        <div class="flex gap-6 text-sm font-medium">
            <span class="text-blue-600">Signatures: {{ $petition->signature_count }}</span>
            <span class="text-green-600">Donations: Rp {{ number_format($petition->donation_total, 0) }}</span>
        </div>
    </div>

    <!-- Donation form -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Support this petition</h3>
        @auth
            <form action="{{ route('donations.store', $petition->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" min="1" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-orange focus:ring-primary-orange">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select name="payment_method"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-orange focus:ring-primary-orange">
                        <option value="">Select…</option>
                        <option value="paypal">PayPal</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <button type="submit"
                        class="w-full py-2 px-4 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">
                    💚 Donate
                </button>
            </form>
        @else
            <p class="text-gray-600 mb-3">Please log in to donate.</p>
            <a href="{{ route('login') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Log in
            </a>
        @endauth
    </div>

    <!-- Recent donations -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Donations</h3>
        @forelse($petition->donations->sortByDesc('created_at') as $donation)
            <div class="flex justify-between py-2 border-b border-gray-200">
                <div>
                    <p class="font-medium text-gray-800">{{ $donation->user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $donation->created_at->format('d M Y H:i') }}</p>
                </div>
                <p class="font-semibold text-green-600">Rp {{ number_format($donation->amount, 0) }}</p>
            </div>
        @empty
            <p class="text-gray-600">No donations yet. Be the first to support this petition!</p>
        @endforelse
    </div>
</div>
@endsection