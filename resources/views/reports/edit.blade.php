@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white shadow-lg rounded-xl p-8">

        <h1 class="text-3xl font-bold text-blue-700 mb-6">
            Edit Wildlife Report
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ url('/reports/' . $report->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Species Name -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Species Name
                </label>

                <input type="text"
                       name="species_name"
                       value="{{ $report->species_name }}"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            <!-- Location -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Location Name
                </label>

                <input type="text"
                       name="location"
                       value="{{ $report->location }}"
                       placeholder="Enter forest/location"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
                       
                <label class="block mb-2 font-semibold text-gray-700">
                    Pinpoint Exact Location (Click on Map)
                </label>

                <!-- Map Container -->
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
                <div id="map" class="w-full h-64 rounded-lg shadow-inner border border-gray-300 z-10 mb-2"></div>
                
                <!-- Hidden Coordinates -->
                <input type="hidden" name="latitude" id="latitude" value="{{ $report->latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $report->longitude }}">
                <p class="text-xs text-gray-500" id="coord-display">
                    {{ $report->latitude && $report->longitude ? 'Selected: ' . number_format($report->latitude, 5) . ', ' . number_format($report->longitude, 5) : 'No coordinates selected.' }}
                </p>

                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var initialLat = {{ $report->latitude ?? 20.0 }};
                        var initialLng = {{ $report->longitude ?? 0.0 }};
                        var hasCoords = {{ $report->latitude && $report->longitude ? 'true' : 'false' }};
                        var zoomLevel = hasCoords ? 8 : 2;

                        var map = L.map('map').setView([initialLat, initialLng], zoomLevel);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 18,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        var marker = null;
                        
                        if (hasCoords) {
                            marker = L.marker([initialLat, initialLng]).addTo(map);
                        }

                        map.on('click', function(e) {
                            if (marker) {
                                map.removeLayer(marker);
                            }
                            marker = L.marker(e.latlng).addTo(map);
                            
                            document.getElementById('latitude').value = e.latlng.lat.toFixed(8);
                            document.getElementById('longitude').value = e.latlng.lng.toFixed(8);
                            document.getElementById('coord-display').innerText = 'Selected: ' + e.latlng.lat.toFixed(5) + ', ' + e.latlng.lng.toFixed(5);
                        });
                    });
                </script>

            </div>

            <!-- Conservation Status -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Conservation Status
                </label>

                <select name="status"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="Endangered"
                        {{ $report->status == 'Endangered' ? 'selected' : '' }}>

                        Endangered

                    </option>

                    <option value="Protected"
                        {{ $report->status == 'Protected' ? 'selected' : '' }}>

                        Protected

                    </option>

                    <option value="Critical"
                        {{ $report->status == 'Critical' ? 'selected' : '' }}>

                        Critical

                    </option>

                </select>

            </div>

            <!-- Description -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Description
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $report->description }}</textarea>

            </div>

            <!-- Current Image -->

            @if($report->image_data)

                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Current Wildlife Image
                    </label>

                    <img src="{{ route('report.image', $report->id) }}"
                         class="w-48 rounded-lg shadow border">

                </div>

            @endif

            <!-- Upload New Image -->

            <div class="mb-6">

                <label class="block mb-2 font-semibold text-gray-700">
                    Change Wildlife Image
                </label>

                <input type="file"
                       name="image"
                       class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50">

            </div>

            <!-- Buttons -->

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">

                    Update Report

                </button>

                <a href="{{ url('/reports') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection