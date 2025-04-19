<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF to Audio App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-700">PDF to Audio</a>

            <div class="space-x-4">
                @auth
                <a href="{{ route('convert.history') }}" class="text-sm text-gray-700 hover:text-blue-600">History</a>
                <span class="text-sm text-gray-600">Hi, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-1 max-w-4xl mx-auto py-8 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center text-sm text-gray-500 py-4 border-t">
        &copy; {{ date('Y') }} PDF to Audio App. All rights reserved.
    </footer>

</body>
</html>
