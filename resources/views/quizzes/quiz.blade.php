@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')
   
    <div id="questions-form-container">
        <form id="quiz-form" action="{{ route('quiz.update', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-2xl font-bold mb-6 text-center">Questions for Quiz: {{ $quiz->name }}</h1>
            @foreach ($quiz->questions as $question)
                @include('questions.question', ['question' => $question])
            @endforeach
        </form>

    </div>

    <div class="flex justify-center mb-4">
        <button type="button" id="add-question-button" data-quiz-id="{{ $quiz->id }}"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Add New Question
        </button>

    </div>

    <div class="flex justify-center mt-4">
        <button type="submit" form="quiz-form" id="submit-questions-button"
            class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
            Submit Questions
        </button>
    </div>
@endsection
