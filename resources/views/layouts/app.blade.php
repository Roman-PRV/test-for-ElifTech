<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">
            <h1 class="text-lg font-bold">My Application</h1>
        </div>
    </header>

    <!-- Content -->
    <main class="container mx-auto my-6">
        @yield('content')

    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white p-4 mt-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} My Application. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
