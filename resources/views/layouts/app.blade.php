<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Forest Tracker</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 text-black min-h-screen">

    <nav class="bg-green-700 shadow">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-white">
                Forest Tracker
            </h1>

            <div class="flex items-center gap-6">

                <a href="{{ url('/reports') }}"
                   class="text-white hover:text-green-200">

                    Reports

                </a>

                <a href="{{ url('/dashboard') }}"
                   class="text-white hover:text-green-200">

                    Dashboard

                </a>

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="bg-red-500 px-4 py-2 rounded text-white hover:bg-red-600">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </nav>

    <main class="max-w-7xl mx-auto p-6">

        @yield('content')

    </main>

</body>

</html>