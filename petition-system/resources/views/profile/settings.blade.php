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
    
    <div id="preferences" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Preferences</h2>
        <form id="preferences-form" method="POST" action="{{ route('profile.preferences.update') }}">
            @csrf
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-gray-800 dark:text-white">Dark Mode</p>
                    <p class="text-sm text-gray-500 dark:text-gray-300">Enable dark theme across the site.</p>
                </div>
                <div class="flex items-center space-x-3">
                    <label for="dark_mode_toggle" class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="dark_mode_toggle" name="dark_mode" value="1" class="sr-only" {{ $user->dark_mode ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-gray-600 rounded-full shadow-inner"></div>
                        <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
                    </label>
                    <button type="submit" class="px-4 py-2 bg-primary-orange text-white rounded shadow hover:bg-orange-600 transition">Save Preferences</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('dark_mode_toggle');
    const dot = document.querySelector('#dark_mode_toggle + div + .dot') || document.querySelector('.dot');

    function setDotPosition() {
        if (!dot) return;
        if (checkbox.checked) {
            dot.style.transform = 'translateX(1.25rem)';
        } else {
            dot.style.transform = 'translateX(0)';
        }
    }

    setDotPosition();

    checkbox && checkbox.addEventListener('change', function (e) {
        setDotPosition();
        // Toggle body class for immediate feedback
        if (checkbox.checked) {
            document.body.classList.add('dark', 'bg-gray-900', 'text-gray-100');
        } else {
            document.body.classList.remove('dark');
            document.body.classList.remove('bg-gray-900', 'text-gray-100');
        }

        // submit via fetch to save preference without full page reload
        const form = document.getElementById('preferences-form');
        const url = form.action;
        const token = document.querySelector('input[name=_token]').value;
        const data = new FormData();
        if (checkbox.checked) data.append('dark_mode', '1');
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: data
        }).then(res => res.json()).then(json => {
            // optionally show a brief toast
            if (json.success) {
                // no-op or show small confirmation
            }
        }).catch(err => console.error(err));
    });
});
</script>
@endsection