@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Quizzes</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($quizzes as $quiz)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow flex flex-col quiz-container"
                data-quiz-id="{{ $quiz->id }}">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-semibold">{{ $quiz->name }}</h2>

                    <div class="relative group">
                        <button
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010-2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg hidden group-focus-within:block">
                            <a href="/quizzes/{{ $quiz->id }}/edit"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 quiz-run-button">Run</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 quiz-deletу-button">Delete</a>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">{{ $quiz->description }}</p>
                <p class="text-gray-600 text-sm my-2">Questions: {{ $quiz->amount_questions }}</p>
                <p class="text-gray-600 text-sm my-2">Completions: {{ $quiz->amount_completions }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $quizzes->links() }}
    </div>
@endsection
