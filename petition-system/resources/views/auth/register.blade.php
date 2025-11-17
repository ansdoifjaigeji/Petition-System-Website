@extends('layouts.app')

@section('title', 'Voice for Change - Sign Up')

@section('content')
<div class="max-w-md mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-dark-navy mb-6 text-center">Create Your Account</h1>
    
    <div class="bg-white p-8 rounded-xl shadow-xl">
        <form class="space-y-6" action="{{ route('register.store') }}" method="POST">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="name" name="name" required autofocus
                       class="mt-1 block w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange" 
                       value="{{ old('name') }}">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange" 
                       value="{{ old('email') }}">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required 
                       class="mt-1 block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-orange focus:border-primary-orange">
            </div>
            
            <button type="submit" class="w-full py-3 text-white font-semibold bg-primary-orange rounded-lg shadow-lg hover:bg-orange-600 transition duration-300 transform hover:scale-[1.01]">
                Register
            </button>
        </form>
        
        <p class="mt-4 text-center text-sm text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-medium text-primary-orange hover:text-orange-600">Log In Here</a>
        </D>
    </div>
</div>
@endsection