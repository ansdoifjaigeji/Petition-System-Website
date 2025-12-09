@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-dark-navy dark:text-white mb-8">Account Settings</h1>
    
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Personal Information</h2>
        <form>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                    <input type="text" value="{{ $user->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" value="{{ $user->email }}" disabled class="mt-1 block w-full border-gray-300 bg-gray-100 rounded-md shadow-sm dark:bg-gray-900 dark:border-gray-600 dark:text-gray-400 p-2 cursor-not-allowed">
                </div>
                <button type="button" class="w-32 py-2 bg-primary-orange text-white rounded shadow hover:bg-orange-600 transition">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection