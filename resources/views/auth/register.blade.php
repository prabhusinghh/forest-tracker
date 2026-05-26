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
                    <label class="relative flex items-start cursor-pointer rounded-lg border bg-white p-4 shadow-sm border-gray-300 hover:bg-gray-50 focus:outline-none transition-all duration-200" id="label-explorer">
                        <div class="flex items-center h-5 mt-0.5">
                            <input type="radio" id="role-explorer" name="role" value="explorer" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 cursor-pointer" checked onchange="updateRoleSelection()">
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="block font-bold text-gray-900">Public Explorer</span>
                            <span class="block mt-1 text-xs text-gray-500">Join discussions & leave comments.</span>
                        </div>
                    </label>

                    <!-- Conservationist Option -->
                    <label class="relative flex items-start cursor-pointer rounded-lg border bg-white p-4 shadow-sm border-gray-300 hover:bg-gray-50 focus:outline-none transition-all duration-200" id="label-conservationist">
                        <div class="flex items-center h-5 mt-0.5">
                            <input type="radio" id="role-conservationist" name="role" value="conservationist" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 cursor-pointer" onchange="updateRoleSelection()">
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="block font-bold text-gray-900">Conservationist</span>
                            <span class="block mt-1 text-xs text-gray-500">Submit reports. (Requires admin approval)</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <script>
                function updateRoleSelection() {
                    const explorerRadio = document.getElementById('role-explorer');
                    const conservationistRadio = document.getElementById('role-conservationist');
                    const explorerLabel = document.getElementById('label-explorer');
                    const conservationistLabel = document.getElementById('label-conservationist');

                    if (explorerRadio && conservationistRadio && explorerLabel && conservationistLabel) {
                        if (explorerRadio.checked) {
                            explorerLabel.classList.add('border-green-500', 'ring-1', 'ring-green-500');
                            explorerLabel.classList.remove('border-gray-300');
                            conservationistLabel.classList.remove('border-green-500', 'ring-1', 'ring-green-500');
                            conservationistLabel.classList.add('border-gray-300');
                        } else {
                            conservationistLabel.classList.add('border-green-500', 'ring-1', 'ring-green-500');
                            conservationistLabel.classList.remove('border-gray-300');
                            explorerLabel.classList.remove('border-green-500', 'ring-1', 'ring-green-500');
                            explorerLabel.classList.add('border-gray-300');
                        }
                    }
                }
                // Run on boot
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', updateRoleSelection);
                } else {
                    updateRoleSelection();
                }
            </script>

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