@extends('layouts.app')

@section('title', 'Voice for Change - Log In')

@section('content')
<div class="max-w-md mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-dark-navy mb-6 text-center">Account Access</h1>
    
    <div class="bg-white p-8 rounded-xl shadow-xl">
        <form class="space-y-6" action="{{ route('login.store') }}" method="POST">
            @csrf
            
            @error('email')
                <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
            @enderror

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange" 
                       placeholder="you@example.com" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange">
            </div>
            
            <button type="submit" class="w-full py-3 text-white font-semibold bg-primary-orange rounded-lg shadow-lg hover:bg-orange-600 transition duration-300 transform hover:scale-[1.01]">
                Log In
            </button>
        </form>
        
        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account? 
        <a href="{{ route('register') }}" class="font-medium text-primary-orange hover:text-orange-600">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection