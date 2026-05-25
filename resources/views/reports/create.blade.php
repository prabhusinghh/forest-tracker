@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white shadow-lg rounded-xl p-8">

        <h1 class="text-3xl font-bold text-green-700 mb-6">
            Create Wildlife Report
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

        <form action="/reports"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- Species Name -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Species Name
                </label>

                <input type="text"
                       name="species_name"
                       placeholder="Enter species name"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">

            </div>

            <!-- Location -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Location
                </label>

                <input type="text"
                       name="location"
                       placeholder="Enter forest/location"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">

            </div>

            <!-- Conservation Status -->

            <div class="mb-5">

                <label class="block mb-2 font-semibold text-gray-700">
                    Conservation Status
                </label>

                <select name="status"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">

                    <option value="">
                        Select Status
                    </option>

                    <option value="Endangered">
                        Endangered
                    </option>

                    <option value="Protected">
                        Protected
                    </option>

                    <option value="Critical">
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
                          placeholder="Enter wildlife monitoring details..."
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>

            </div>

            <!-- Image Upload -->

            <div class="mb-6">

                <label class="block mb-2 font-semibold text-gray-700">
                    Wildlife Image
                </label>

                <input type="file"
                       name="image"
                       class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50">

            </div>

            <!-- Buttons -->

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow">

                    Save Report

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