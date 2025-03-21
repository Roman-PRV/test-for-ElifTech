@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Questions for Quiz: {{ $quiz->name }}</h1>
    <div id="questions-form-container">
        @foreach ($quiz->questions as $question)
            @include('questions.question', ['question' => $question])
        @endforeach
    </div>

    <div class="flex justify-center mb-4">
        <button type="button" id="add-question-button" data-quiz-id="{{ $quiz->id }}"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Add New Question
        </button>

    </div>
@endsection
