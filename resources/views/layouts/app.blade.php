<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Todo App' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <header class="bg-blue-600 text-white py-4 shadow">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex">
                    <img src="{{ asset('/images/logo.png') }}" alt="logo" width="50" class="bg-white mr-2 rounded">
                    <h1 class="text-2xl font-bold">Bizlist App</h1>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white text-blue-600 py-2 px-4 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </header>
        <main class="flex-grow container mx-auto px-4 mt-6">
            @yield('content')
        </main>
        <footer class="bg-gray-800 text-white text-center py-4 mt-6">
            <p>&copy; {{ date('Y') }} BizlyHub App. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
