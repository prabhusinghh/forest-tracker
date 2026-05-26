<x-guest-layout>

    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8">

        <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
            Forest Tracker
        </h1>

        <p class="text-center text-gray-500 mb-8">
            Wildlife Conservation Login
        </p>
        @if(session('error'))

    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">

        {{ session('error') }}

    </div>

@endif
        <form method="POST" action="{{ route('login') }}">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500 @error('email') border-red-500 @enderror">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500 @error('password') border-red-500 @enderror">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">

                Login

            </button>

        </form>

        <p class="text-center mt-6 text-gray-600">

            Don't have an account?

            <a href="{{ route('register') }}"
               class="text-green-600 font-semibold hover:underline">

                Register

            </a>

        </p>

    </div>

</x-guest-layout>