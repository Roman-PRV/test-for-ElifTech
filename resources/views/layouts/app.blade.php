<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Questionnaire Builder App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    --

</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-right gap-3 items-center">
            <h1 class="text-lg font-bold">Questionnaire Builder App</h1>
            <a href="/quizzes" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-200">
                Catalog
            </a>
            <a href="/quizzes/create" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-200">
                Create quiz
            </a>
        </div>
    </header>

    <main class="container mx-auto my-6">
        @yield('content')

    </main>

    <footer class="bg-blue-600 text-white p-4 mt-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Questionnaire Builder App</p>
        </div>
    </footer>

</body>

</html>
