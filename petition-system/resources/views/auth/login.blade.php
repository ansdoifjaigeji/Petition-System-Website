@extends('layouts.app')

@section('title', 'Voice for Change - Log In')

@section('content')
<div class="max-w-md mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-dark-navy mb-6 text-center">Account Access</h1>
    
    <div class="bg-white p-8 rounded-xl shadow-xl">
        {{-- Login form: posts to the session-based login route. The form
             includes a CSRF token for protection and uses server-side
             validation; errors are shown above the fields when present. --}}
        <form class="space-y-6" action="{{ route('login.store') }}" method="POST">
            @csrf
            
            {{-- Validation error for email (also used for general auth failure messages) --}}
            @error('email')
                <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
            @enderror

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                {{-- `old('email')` repopulates the field after validation errors --}}
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange" 
                       placeholder="you@example.com" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                {{-- Password field is not repopulated for security reasons --}}
                <input type="password" id="password" name="password" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange">
            </div>
            
            {{-- Submit button posts the login form; JS clients can instead
                 call the API login endpoint to receive a token. --}}
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