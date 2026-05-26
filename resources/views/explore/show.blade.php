@extends('layouts.public')

@section('title', $report->species_name . ' - Wildlife Explorer')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Back Button -->
    <div class="mb-8">
        <a href="{{ url('/explore') }}" class="inline-flex items-center text-gray-500 hover:text-green-600 font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Explorer
        </a>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        
        <!-- Image Header -->
        <div class="aspect-w-16 aspect-h-9 relative bg-gray-100">
            @if ($report->image)
                <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->species_name }}" class="w-full h-[400px] object-cover">
            @else
                <div class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 bg-gray-50">
                    <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-lg font-medium">No Image Provided</span>
                </div>
            @endif
        </div>

        <!-- Details Section -->
        <div class="p-8 md:p-12">
            <!-- Header Info -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-8">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $report->species_name }}</h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $report->location }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Observed on {{ $report->created_at->format('F j, Y') }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Reported by {{ $report->user ? $report->user->name : 'Unknown' }}
                        </span>
                    </div>
                </div>
                <div>
                    @if($report->status == 'Endangered' || $report->status == 'Critical')
                        <span class="inline-block bg-red-50 text-red-700 border border-red-200 text-sm font-bold px-4 py-2 rounded-full shadow-sm">{{ $report->status }}</span>
                    @elseif($report->status == 'Protected')
                        <span class="inline-block bg-blue-50 text-blue-700 border border-blue-200 text-sm font-bold px-4 py-2 rounded-full shadow-sm">{{ $report->status }}</span>
                    @else
                        <span class="inline-block bg-gray-50 text-gray-700 border border-gray-200 text-sm font-bold px-4 py-2 rounded-full shadow-sm">{{ $report->status }}</span>
                    @endif
                </div>
            </div>

            <!-- Divider -->
            <div class="h-px bg-gray-100 w-full mb-8"></div>

            <!-- Description -->
            <div class="mb-12">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Observation Details</h3>
                <div class="prose max-w-none text-gray-600 leading-relaxed">
                    {{ $report->description }}
                </div>
            </div>

            <!-- Map Location -->
            @if($report->latitude && $report->longitude)
                <div class="mb-12">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Exact Location</h3>
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
                    <div id="show-map" class="w-full h-80 rounded-2xl shadow-inner border border-gray-200 z-10"></div>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var lat = {{ $report->latitude }};
                            var lng = {{ $report->longitude }};
                            var map = L.map('show-map').setView([lat, lng], 10);
                            
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 18,
                                attribution: '© OpenStreetMap'
                            }).addTo(map);

                            L.marker([lat, lng]).addTo(map)
                                .bindPopup("<b>{{ addslashes($report->species_name) }}</b><br>{{ addslashes($report->location) }}")
                                .openPopup();
                        });
                    </script>
                </div>
            @endif

            <!-- Divider -->
            <div class="h-px bg-gray-100 w-full mb-8"></div>

            <!-- Community Discussion (Comments) -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Community Discussion</h3>
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Comments List -->
                <div class="space-y-6 mb-8">
                    @forelse($report->comments as $comment)
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-2xl border border-gray-100 border-dashed">
                            No comments yet. Be the first to start the discussion!
                        </div>
                    @endforelse
                </div>

                <!-- Add Comment Form -->
                @auth
                    <form action="{{ url('/explore/' . $report->id . '/comments') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="sr-only">Leave a comment</label>
                            <textarea id="body" name="body" rows="3" class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Join the discussion... share your thoughts or verify this sighting!" required></textarea>
                            @error('body')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-transform transform hover:-translate-y-1">
                                Post Comment
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-2xl border border-gray-200 text-center">
                        <p class="text-gray-600 mb-4 font-medium">Log in or join to participate in the discussion.</p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('login') }}" class="bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 px-6 py-2 rounded-full font-bold shadow-sm transition-colors">Log in</a>
                            <a href="{{ route('register') }}" class="bg-green-600 text-white hover:bg-green-500 px-6 py-2 rounded-full font-bold shadow-sm transition-colors">Join</a>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</div>
@endsection
