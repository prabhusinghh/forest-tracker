<x-guest-layout>

    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8">

        <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
            Forest Tracker
        </h1>

        <p class="text-center text-gray-500 mb-8">
            Create Conservation Account
        </p>

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Name
                </label>

                <input type="text"
                       name="name"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500">

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500">

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500">

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Confirm Password
                </label>

                <input type="password"
                       name="password_confirmation"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500">

            </div>

            <!-- Account Type Selection -->
            <div class="mb-8">
                <label class="block mb-3 font-semibold text-gray-800 text-lg">
                    Account Type
                </label>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Explorer Option -->
                    <label class="group relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none border-gray-300 hover:bg-gray-50 has-[:checked]:border-green-500 has-[:checked]:ring-1 has-[:checked]:ring-green-500">
                        <input type="radio" name="role" value="explorer" class="sr-only" checked>
                        <span class="flex flex-1">
                            <span class="flex flex-col">
                                <span class="block text-sm font-bold text-gray-900">Public Explorer</span>
                                <span class="mt-1 flex items-center text-sm text-gray-500">Join discussions & leave comments.</span>
                            </span>
                        </span>
                        <svg class="h-5 w-5 text-green-600 hidden group-has-[:checked]:block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    </label>

                    <!-- Conservationist Option -->
                    <label class="group relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none border-gray-300 hover:bg-gray-50 has-[:checked]:border-green-500 has-[:checked]:ring-1 has-[:checked]:ring-green-500">
                        <input type="radio" name="role" value="conservationist" class="sr-only">
                        <span class="flex flex-1">
                            <span class="flex flex-col">
                                <span class="block text-sm font-bold text-gray-900">Conservationist</span>
                                <span class="mt-1 flex items-center text-sm text-gray-500">Submit reports. (Requires admin approval)</span>
                            </span>
                        </span>
                        <svg class="h-5 w-5 text-green-600 hidden group-has-[:checked]:block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">

                Register

            </button>

        </form>

        <p class="text-center mt-6 text-gray-600">

            Already have an account?

            <a href="{{ route('login') }}"
               class="text-green-600 font-semibold hover:underline">

                Login

            </a>

        </p>

    </div>

</x-guest-layout>