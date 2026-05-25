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

        <form action="/reports/{{ $report->id }}"
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
                    Location
                </label>

                <input type="text"
                       name="location"
                       value="{{ $report->location }}"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

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

            @if($report->image)

                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Current Wildlife Image
                    </label>

                    <img src="{{ asset('storage/' . $report->image) }}"
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

                <a href="/reports"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection