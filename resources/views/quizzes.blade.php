@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Quizzes</h1>

    <!-- Адаптивна сітка -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($quizzes as $quiz)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow flex flex-col">
                <!-- Блок із назвою та бургер-меню -->
                <div class="flex justify-between items-start mb-4">
                    <!-- Назва -->
                    <h2 class="text-lg font-semibold">{{ $quiz->name }}</h2>

                    <!-- Бургер-меню -->
                    <div class="relative group">
                        <!-- Іконка бургер-меню -->
                        <button
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400"
                            id="menu-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Меню -->
                        <div id="menu-content"
                            class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg hidden group-focus-within:block">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Run</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                        </div>
                    </div>
                </div>

                <!-- Вміст картки -->
                <p class="text-gray-600">{{ $quiz->description }}</p>
                <p class="text-gray-600 text-sm my-2">Questions: {{ $quiz->amount_questions }}</p>
            </div>
        @endforeach
    </div>

    <!-- Пагінація -->
    <div class="mt-6">
        {{ $quizzes->links() }}
    </div>
@endsection
