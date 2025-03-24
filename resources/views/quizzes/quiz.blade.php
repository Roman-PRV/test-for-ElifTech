@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')

    <div id="questions-form-container" class="flex justify-center py-8">
        <form id="quiz-form" action="{{ route('quizzes.update', $quiz->id) }}" method="POST"
            class="w-4/5 bg-white shadow-md rounded-lg p-8">
            @csrf
            @method('PUT')

            <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">
                Questions for Quiz:
                <input type="text" name="quiz-name" value="{{ $quiz->name }}"
                    class="ml-2 mt-2 text-lg p-2 w-3/5 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Quiz name" />
            </h1>

            <textarea name="quiz-description"
                class="w-full bg-gray-100 p-4 mb-6 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Quiz description">{{ $quiz->description }}</textarea>

            @foreach ($quiz->questions as $question)
                @include('questions.question', ['question' => $question])
            @endforeach
        </form>
    </div>

    <div class="flex justify-center mb-4">
        <button type="button" id="add-question-button" data-quiz-id="{{ $quiz->id }}"
            class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 hover:shadow-lg transition duration-300">
            Add New Question
        </button>
    </div>

    <div class="flex justify-center mt-4">
        <button type="submit" form="quiz-form" id="submit-questions-button"
            class="bg-green-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300">
            Submit Quiz
        </button>
    </div>

@endsection
