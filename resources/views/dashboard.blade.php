@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Welcome Section -->

    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white rounded-2xl shadow-lg p-8 mb-8">

        <h1 class="text-4xl font-bold mb-3">
            Forest & Wildlife Conservation Dashboard
        </h1>

        <p class="text-lg text-green-100">
            Monitor conservation activities, wildlife reports,
            environmental status, and protected species updates.
        </p>

    </div>

    <!-- Statistics Cards -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <!-- Total Reports -->

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-600">

            <h2 class="text-gray-500 text-sm uppercase mb-2">
                Total Reports
            </h2>

            <p class="text-4xl font-bold text-green-700">
                {{ \App\Models\Report::count() }}
            </p>

        </div>

        <!-- Endangered Species -->

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-500">

            <h2 class="text-gray-500 text-sm uppercase mb-2">
                Endangered Species
            </h2>

            <p class="text-4xl font-bold text-red-600">
                {{ \App\Models\Report::where('status', 'Endangered')->count() }}
            </p>

        </div>

        <!-- Protected Species -->

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-500">

            <h2 class="text-gray-500 text-sm uppercase mb-2">
                Protected Species
            </h2>

            <p class="text-4xl font-bold text-blue-600">
                {{ \App\Models\Report::where('status', 'Protected')->count() }}
            </p>

        </div>

        <!-- Critical Species -->

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-yellow-500">

            <h2 class="text-gray-500 text-sm uppercase mb-2">
                Critical Cases
            </h2>

            <p class="text-4xl font-bold text-yellow-600">
                {{ \App\Models\Report::where('status', 'Critical')->count() }}
            </p>

        </div>

    </div>

    <!-- Quick Actions -->

    <div class="bg-white rounded-2xl shadow p-8 mb-10">

        <h2 class="text-2xl font-bold text-gray-700 mb-6">
            Quick Actions
        </h2>

        <div class="flex flex-wrap gap-4">

            <a href="{{ url('/reports') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow">

                View Reports

            </a>

            <a href="{{ url('/reports/create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">

                Add Wildlife Report

            </a>

            @if(auth()->user()->role === 'admin')

                <a href="{{ url('/admin/pending-users') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg shadow">

                    Manage Pending Users

                </a>

            @endif

        </div>

    </div>

    <!-- Recent Activity -->

    <div class="bg-white rounded-2xl shadow p-8">

        <h2 class="text-2xl font-bold text-gray-700 mb-6">
            Recent Wildlife Reports
        </h2>

        <div class="space-y-4">

            @foreach(\App\Models\Report::latest()->take(5)->get() as $report)

                <div class="border rounded-xl p-4 flex justify-between items-center">

                    <div>

                        <h3 class="text-lg font-semibold text-green-700">
                            {{ $report->species_name }}
                        </h3>

                        <p class="text-gray-600">
                            {{ $report->location }}
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-full text-white
                        @if($report->status == 'Endangered')
                            bg-red-500
                        @elseif($report->status == 'Protected')
                            bg-blue-500
                        @else
                            bg-yellow-500
                        @endif">

                        {{ $report->status }}

                    </span>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection