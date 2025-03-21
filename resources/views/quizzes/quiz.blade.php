@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Questions for Quiz: {{ $quiz->name }}</h1>
    @foreach ($quiz->questions as $question)
        @include('questions.question', ['question' => $question])
    @endforeach
@endsection
