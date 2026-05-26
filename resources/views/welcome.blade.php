<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forest Tracker | Wildlife Conservation Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 selection:bg-green-500 selection:text-white">

    <!-- Navigation -->
    <nav class="absolute top-0 w-full z-50 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-bold text-white tracking-tight">Forest<span class="text-green-400">Tracker</span></span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#mission" class="text-white/90 hover:text-white font-medium transition-colors">Mission</a>
                    <a href="#stats" class="text-white/90 hover:text-white font-medium transition-colors">Impact</a>
                    <a href="#species" class="text-white/90 hover:text-white font-medium transition-colors">Species</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4 ml-6 pl-6 border-l border-white/20">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white font-semibold hover:text-green-300 transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-white font-medium hover:text-green-300 transition-colors">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-400 text-white px-5 py-2.5 rounded-full font-semibold transition-all transform hover:scale-105 shadow-lg shadow-green-500/30">
                                        Join Conservationists
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gray-900 min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero_forest.png') }}" alt="Lush Tropical Forest" class="w-full h-full object-cover opacity-60 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/80 via-gray-900/30 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <span class="inline-block py-1 px-3 rounded-full bg-green-500/20 text-green-300 font-semibold text-sm mb-6 border border-green-500/30 backdrop-blur-sm">
                Advanced Wildlife Conservation Platform
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight max-w-4xl mx-auto">
                Protect Wildlife <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">Before It's Too Late.</span>
            </h1>
            <p class="mt-4 max-w-2xl text-xl text-gray-300 mx-auto mb-10 font-medium">
                Join our global network of conservationists. Track, report, and analyze wildlife data to protect endangered species and preserve natural habitats.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/reports') }}" class="bg-white text-gray-900 hover:bg-gray-100 px-8 py-4 rounded-full font-bold text-lg transition-all transform hover:-translate-y-1 shadow-xl">
                    Explore Reports
                </a>
                <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-500 text-white px-8 py-4 rounded-full font-bold text-lg transition-all transform hover:-translate-y-1 shadow-xl shadow-green-600/30 flex items-center justify-center gap-2">
                    Join Conservationists
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Live Statistics Section -->
    <section id="stats" class="relative -mt-24 z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Live Global Impact</h2>
                <p class="text-gray-500 mt-2">Real-time data from our conservation network</p>
            </div>
            <dl class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Stat 1 -->
                <div class="flex flex-col items-center p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-green-200 transition-colors">
                    <dt class="text-base font-medium text-gray-500 mb-2">Total Reports</dt>
                    <dd class="text-5xl font-extrabold text-green-600">{{ $stats['reports'] }}</dd>
                </div>
                <!-- Stat 2 -->
                <div class="flex flex-col items-center p-6 bg-red-50/50 rounded-2xl border border-red-100 hover:border-red-200 transition-colors">
                    <dt class="text-base font-medium text-red-500 mb-2">Endangered Species</dt>
                    <dd class="text-5xl font-extrabold text-red-600">{{ $stats['endangered'] }}</dd>
                </div>
                <!-- Stat 3 -->
                <div class="flex flex-col items-center p-6 bg-blue-50/50 rounded-2xl border border-blue-100 hover:border-blue-200 transition-colors">
                    <dt class="text-base font-medium text-blue-500 mb-2">Active Conservationists</dt>
                    <dd class="text-5xl font-extrabold text-blue-600">{{ $stats['conservationists'] }}</dd>
                </div>
                <!-- Stat 4 -->
                <div class="flex flex-col items-center p-6 bg-amber-50/50 rounded-2xl border border-amber-100 hover:border-amber-200 transition-colors">
                    <dt class="text-base font-medium text-amber-600 mb-2">Protected Regions</dt>
                    <dd class="text-5xl font-extrabold text-amber-500">{{ $stats['regions'] }}</dd>
                </div>
            </dl>
        </div>
    </section>

    <!-- Featured Species Section -->
    <section id="species" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-bold tracking-wide text-green-600 uppercase mb-2">Wildlife Focus</h2>
                <h3 class="text-4xl font-extrabold text-gray-900 mb-4">Featured Protected Species</h3>
                <p class="text-xl text-gray-500 max-w-2xl mx-auto">Discover the magnificent creatures we are working tirelessly to protect across the globe.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Tiger -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-w-4 aspect-h-5 relative h-64 overflow-hidden">
                        <img src="{{ asset('images/species_tiger.png') }}" alt="Bengal Tiger" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Endangered</div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Bengal Tiger</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">A majestic apex predator vital to the health of diverse forest ecosystems across Asia.</p>
                        <a href="{{ url('/reports?species_name=tiger') }}" class="text-green-600 font-semibold hover:text-green-700 flex items-center text-sm">
                            View Reports <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Elephant -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-w-4 aspect-h-5 relative h-64 overflow-hidden">
                        <img src="{{ asset('images/species_elephant.png') }}" alt="Asian Elephant" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Endangered</div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Asian Elephant</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Magnificent ecosystem engineers that shape their forest habitats and support biodiversity.</p>
                        <a href="{{ url('/reports?species_name=elephant') }}" class="text-green-600 font-semibold hover:text-green-700 flex items-center text-sm">
                            View Reports <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Red Panda -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-w-4 aspect-h-5 relative h-64 overflow-hidden">
                        <img src="{{ asset('images/species_red_panda.png') }}" alt="Red Panda" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Endangered</div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Red Panda</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Unique arboreal mammals native to the eastern Himalayas and southwestern China.</p>
                        <a href="{{ url('/reports?species_name=panda') }}" class="text-green-600 font-semibold hover:text-green-700 flex items-center text-sm">
                            View Reports <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Rhino -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-w-4 aspect-h-5 relative h-64 overflow-hidden">
                        <img src="{{ asset('images/species_rhino.png') }}" alt="Indian Rhino" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Protected</div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Indian Rhinoceros</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Powerful herbivores with armor-like skin, found in the grasslands and forests of the Indian subcontinent.</p>
                        <a href="{{ url('/reports?species_name=rhino') }}" class="text-green-600 font-semibold hover:text-green-700 flex items-center text-sm">
                            View Reports <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-green-700 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <defs><pattern id="pattern" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="2" fill="none"/></pattern></defs>
                <rect width="100%" height="100%" fill="url(#pattern)" />
            </svg>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Ready to make an impact?</span>
                <span class="block text-green-200 mt-2">Join our conservation network today.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-green-100 mb-8">
                Your observations and reports contribute directly to global wildlife conservation efforts and database tracking.
            </p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-full text-green-700 bg-white hover:bg-gray-50 shadow-xl transition-transform transform hover:scale-105">
                Create Free Account
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <span class="text-xl font-bold text-white tracking-tight">Forest<span class="text-green-400">Tracker</span></span>
                <p class="mt-2 text-sm">Empowering conservationists with data.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition-colors">About Us</a>
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-8 border-t border-gray-800 text-center text-sm">
            &copy; {{ date('Y') }} Forest Tracker. All rights reserved.
        </div>
    </footer>

</body>
</html>
