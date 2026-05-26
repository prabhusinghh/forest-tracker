@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Pending Users
</h1>

<table class="w-full bg-white shadow rounded">

    <thead class="bg-green-600 text-white">

        <tr>

            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Role</th>
            <th class="p-3">Action</th>

        </tr>

    </thead>

    <tbody>

        @foreach($users as $user)

        <tr class="border-b">

            <td class="p-3">{{ $user->name }}</td>

            <td class="p-3">{{ $user->email }}</td>

            <td class="p-3">{{ $user->role }}</td>

            <td class="p-3">

                <form action="{{ url('/admin/approve/' . $user->id) }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded">

                        Approve

                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection
