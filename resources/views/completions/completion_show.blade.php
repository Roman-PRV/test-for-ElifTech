@extends('layouts.app')

@section('title', 'Quiz Results')

@section('content')
    <!-- Заголовок з назвою вікторини -->
    <h1 class="text-2xl font-bold mb-6 text-center">Quiz Results: {{ $completion->quiz->name }}</h1>
    <h2 class="text-xl font-bold mb-6 text-center">Time to complete: {{ $differenceInMinutes }} minutes </h2>



    <!-- Перелік питань та відповідей -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        @foreach ($completion->questions as $completionQuestion)
            <div class="mb-6">
                <!-- Питання -->
                <h2 class="text-lg font-semibold">{{ $completionQuestion->question_description }}</h2>

                <!-- Відповіді -->
                <ul class="list-disc list-inside mt-2">
                    @foreach ($completionQuestion->answers as $completionAnswer)
                        <li class="text-gray-700">{{ $completionAnswer->answer }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>


@endsection
