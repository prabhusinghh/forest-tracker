<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forest Tracker | @yield('title', 'Explore Wildlife')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 selection:bg-green-500 selection:text-white">

    <!-- Navigation -->
    <nav class="bg-gray-900 shadow-md" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-white tracking-tight">Forest<span class="text-green-400">Tracker</span></a>
                </div>
                <!-- Desktop Links (Hidden on mobile) -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ url('/explore') }}" class="text-white hover:text-green-300 font-medium transition-colors">Explorer</a>
                </div>

                <!-- Always visible Auth Links (Desktop) -->
                <div class="hidden md:flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold transition-all">
                                Log in
                            </a>
                        @endauth
                    @endif
                </div>

                <!-- Hamburger menu button (Mobile only) -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" type="button" class="text-white hover:text-gray-300 focus:outline-none p-2">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden bg-gray-800" style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ url('/explore') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Explorer</a>
                
                @if (Route::has('login'))
                    <div class="mt-4 border-t border-gray-700 pt-4 pb-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="block w-full text-center px-4 py-2 bg-green-600 hover:bg-green-500 rounded-md text-base font-medium text-white">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-green-600 hover:bg-green-500 rounded-md text-base font-medium text-white">Log in</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 mt-auto border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            &copy; {{ date('Y') }} Forest Tracker. All rights reserved.
        </div>
    </footer>

</body>
</html>
