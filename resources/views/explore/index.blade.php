@extends('layouts.public')

@section('title', 'Public Wildlife Explorer')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Wildlife Explorer</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Browse thousands of wildlife observations contributed by our global conservation network.</p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-10">
        <form method="GET" action="{{ url('/explore') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="sr-only">Search species</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search species (e.g. Tiger, Elephant)..." class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm py-3 px-4">
            </div>
            <div class="w-full md:w-64">
                <label for="status" class="sr-only">Filter by Status</label>
                <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm py-3 px-4">
                    <option value="">All Statuses</option>
                    <option value="Stable" {{ request('status') == 'Stable' ? 'selected' : '' }}>Stable</option>
                    <option value="Endangered" {{ request('status') == 'Endangered' ? 'selected' : '' }}>Endangered</option>
                    <option value="Critically Endangered" {{ request('status') == 'Critically Endangered' ? 'selected' : '' }}>Critically Endangered</option>
                    <option value="Extinct" {{ request('status') == 'Extinct' ? 'selected' : '' }}>Extinct</option>
                </select>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-8 py-3 rounded-lg font-semibold transition-colors flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Search
            </button>
            @if(request('search') || request('status'))
                <a href="{{ url('/explore') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($reports as $report)
            <a href="{{ url('/explore/' . $report->id) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full transform hover:-translate-y-1">
                <!-- Image Container -->
                <div class="aspect-w-16 aspect-h-10 relative bg-gray-100 overflow-hidden">
                    @if ($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->species_name }}" class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @else
                        <!-- Placeholder if no image -->
                        <div class="w-full h-64 flex flex-col items-center justify-center text-gray-400 bg-gray-50">
                            <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium">No Image Provided</span>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        @if($report->status == 'Endangered' || $report->status == 'Critically Endangered')
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $report->status }}</span>
                        @elseif($report->status == 'Extinct')
                            <span class="bg-gray-800 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $report->status }}</span>
                        @else
                            <span class="bg-blue-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $report->status }}</span>
                        @endif
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $report->species_name }}</h2>
                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $report->location }}
                    </div>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-grow">{{ $report->description }}</p>
                    <div class="text-green-600 font-medium text-sm flex items-center mt-auto">
                        View Full Details <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-gray-100">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No wildlife reports found</h3>
                <p class="text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                <a href="{{ url('/explore') }}" class="mt-4 inline-block text-green-600 hover:text-green-500 font-medium">Clear all filters</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $reports->links() }}
    </div>

</div>
@endsection
