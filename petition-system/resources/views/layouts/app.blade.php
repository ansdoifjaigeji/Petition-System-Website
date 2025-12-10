<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Voice for Change')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary-orange': '#1a7d10aa',
                        'dark-navy': '#2e35a8ff',
                    }
                }
            }
        }
    </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7;
        }

        .hero-section {
            background-image: url("{{ asset('images/hero-background.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 70vh;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.45);
        }
    </style>
</head>
<body class="{{ auth()->check() && auth()->user()->dark_mode ? 'dark bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900' }}">

    @if (session('success'))
        <div id="flash-message" class="fixed top-5 right-5 bg-green-600 text-white px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center border-l-4 border-green-800 transform transition-all duration-500 translate-y-0 opacity-100">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <div>
                <h4 class="font-bold text-lg">Success!</h4>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('flash-message').remove()" class="ml-6 text-green-200 hover:text-white focus:outline-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <script>setTimeout(function() { const f = document.getElementById('flash-message'); if(f){ f.style.opacity='0'; setTimeout(()=>f.remove(),500); } }, 100);</script> <!-- this part is to configure the pop up message timer, change the 100 if you want to configure it -->
    @endif

    @if (session('logout'))
        <div id="flash-message-red" class="fixed top-5 right-5 bg-red-600 text-white px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center border-l-4 border-red-800 transform transition-all duration-500 translate-y-0 opacity-100">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            <div>
                <h4 class="font-bold text-lg">Logged Out</h4>
                <p class="text-sm">{{ session('logout') }}</p>
            </div>
            <button onclick="document.getElementById('flash-message-red').remove()" class="ml-6 text-red-200 hover:text-white focus:outline-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <script>setTimeout(function() { const f = document.getElementById('flash-message-red'); if(f){ f.style.opacity='0'; setTimeout(()=>f.remove(),500); } }, 100);</script> <!-- this part is to configure the pop up message timer, change the 100 if you want to configure it -->
    @endif

    <header class="bg-white shadow-md relative z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex justify-between items-center py-4">
                
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-primary-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="text-xl font-bold text-dark-navy">VOICE FOR CHANGE</span>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">Home</a>
                    <a href="{{ route('petitions.index') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">Explore</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">About Us</a>

                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">Log In</a>
                    @endguest

                    @auth
                        <div class="relative ml-3 group">
                            <button type="button" class="flex items-center space-x-2 text-sm focus:outline-none">
                                <div class="h-9 w-9 rounded-full bg-primary-orange flex items-center justify-center text-white font-bold text-lg uppercase shadow-md border-2 border-white">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:block font-medium text-gray-700 group-hover:text-primary-orange transition">
                                    {{ auth()->user()->name }}
                                </span>
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-primary-orange transition transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform z-50 border border-gray-100">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm text-gray-500">Signed in as</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                                <a href="{{ route('profile.settings') }}#preferences" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Preferences</a>
                                <a href="{{ route('profile.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    <a href="{{ route('petitions.create') }}" class="px-5 py-2 text-white font-semibold bg-primary-orange rounded-lg shadow-lg hover:bg-orange-600 transition duration-300 transform hover:scale-105">
                        START A PETITION
                    </a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-600 hover:text-primary-orange focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </nav>
        </div>

        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Home</a>
                <a href="{{ route('petitions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Explore</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">About Us</a>
                
                @guest
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Log In</a>
                @endguest

                @auth
                    <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">My Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="block w-full text-left">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Log Out</button>
                    </form>
                @endauth

                <a href="{{ route('petitions.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-primary-orange text-center mt-2">START A PETITION</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer class="bg-dark-navy text-white mt-10">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2025 Voice For Change. All rights reserved. | <a href="#" class="hover:text-primary-orange">Privacy Policy</a></p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            if(button && menu) {
                button.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>