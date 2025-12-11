@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-dark-navy dark:text-white mb-8">Account Settings</h1>
    
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Personal Information</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-32 py-2 bg-primary-orange text-white rounded shadow hover:bg-orange-600 transition">Save</button>
            </div>
        </form>
    </div>
    
    <div id="preferences" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Preferences</h2>
        <form id="preferences-form" method="POST" action="{{ route('profile.preferences.update') }}">
            @csrf
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-gray-800 dark:text-white">Dark Mode</p>
                    <p class="text-sm text-gray-500 dark:text-gray-300">Enable dark theme across the site.</p>
                </div>
                <div class="flex items-center space-x-3">
                    {{-- Toggle control: uses an invisible checkbox for accessibility and
                        a styled element for the visible switch. The `sr-only` class
                        keeps the input available to screen readers while the UI
                        presents a modern toggle. --}}
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

    <!-- Change Password Section -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Change Password</h2>
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                    <input id="current_password" name="current_password" type="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                    @error('current_password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                    <input id="password" name="password" type="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                </div>

                <div>
                    <button type="submit" class="px-4 py-2 bg-primary-orange text-white rounded shadow hover:bg-orange-600 transition">Change Password</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete Account Section -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 border-l-4 border-red-500">
        <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Warning!</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Permanently delete your account and all associated data. This action cannot be undone.</p>
        <button type="button" id="delete-account-btn" class="px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">Delete My Account</button>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-red-600 mb-2">Delete Account?</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4">Are you sure? This action is permanent and cannot be reversed. All your petitions and data will be deleted.</p>
        
        <form id="delete-form" method="POST" action="{{ route('profile.delete-account') }}">
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm your password</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex gap-3">
                <button type="button" id="cancel-delete-btn" class="flex-1 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded shadow hover:bg-gray-400 dark:hover:bg-gray-700 transition">Cancel</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">Delete Account</button>
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

    // When the checkbox changes we:
    // 1) animate the dot for immediate UI feedback
    // 2) toggle the `dark` class on the `body` so Tailwind dark: utilities apply
    // 3) send an AJAX POST so the preference persists without a full reload
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
        // Submit preference change via fetch; we include the CSRF token header
        // and POST the value so the server can persist it.
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

    // Delete Account Modal Handler
    // Shows confirmation modal when user clicks delete button
    const deleteBtn = document.getElementById('delete-account-btn');
    const deleteModal = document.getElementById('delete-modal');
    const cancelBtn = document.getElementById('cancel-delete-btn');

    deleteBtn && deleteBtn.addEventListener('click', function() {
        deleteModal.classList.remove('hidden');
    });

    cancelBtn && cancelBtn.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
        document.getElementById('password').value = '';
    });

    // Close modal when clicking outside of it
    deleteModal && deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
            document.getElementById('password').value = '';
        }
    });
});
</script>
@endsection