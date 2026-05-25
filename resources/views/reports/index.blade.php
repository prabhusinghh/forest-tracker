@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold text-green-700">
            Wildlife Reports
        </h1>
        
        <a href="/reports/create"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

            Add Report

        </a>

    </div>
    <form method="GET"
      action="/reports"
      class="bg-white p-4 rounded shadow mb-6">

    <div class="grid grid-cols-3 gap-4">

        <input type="text"
               name="species_name"
               placeholder="Search Species"
               value="{{ request('species_name') }}"
               class="border p-2 rounded">

        <input type="text"
               name="location"
               placeholder="Search Location"
               value="{{ request('location') }}"
               class="border p-2 rounded">

        <select name="status"
                class="border p-2 rounded">

            <option value="">
                All Status
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

    <button type="submit"
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded">

        Filter Reports

    </button>

</form>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-600 text-white">

                <tr>

                    <th class="p-3 text-left">Species</th>
                    <th class="p-3 text-left">Location</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Image</th>
                    <th class="p-3 text-left">Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach($reports as $report)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $report->species_name }}
                    </td>

                    <td class="p-3">
                        {{ $report->location }}
                    </td>

                    <td class="p-3">
                        {{ $report->status }}
                    </td>

                    <td class="p-3">
                        {{ $report->description }}
                    </td>

                    <td class="p-3">

                        @if($report->image)

                            <img src="{{ asset('storage/' . $report->image) }}"
                                 width="100"
                                 class="rounded">

                        @endif

                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="/reports/{{ $report->id }}/edit"
                           class="bg-blue-500 text-white px-3 py-1 rounded">

                            Edit

                        </a>

                        <form action="/reports/{{ $report->id }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection