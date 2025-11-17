<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Voice for Change')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7;
        }

        /* Updated asset path for the background image */
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
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-orange': '#1a7d10aa', // Your custom color
                        'dark-navy': '#2e35a8ff',   // Your custom color
                    }
                }
            }
        }
    </script>
</head>
<body>

    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex justify-between items-center py-4">
                
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-primary-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="text-xl font-bold text-dark-navy">VOICE FOR CHANGE</span>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">Home</a>
                    <a href="{{ route('petitions.index') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">Explore</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">About Us</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-orange transition duration-200 font-medium">Log In</a>

                    <a href="{{ route('petitions.create') }}" class="px-5 py-2 text-white font-semibold bg-primary-orange rounded-lg shadow-lg hover:bg-orange-600 transition duration-300 transform hover:scale-105">
                        START A PETITION
                    </a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-600 hover:text-primary-orange focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </nav>
        </div>

        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Home</a>
                <a href="{{ route('petitions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Explore</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">About Us</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Log In</a>
                <a href="{{ route('petitions.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-primary-orange text-center mt-2">
                    START A PETITION
                </a>
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

            button.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>