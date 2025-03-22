@extends('layouts.app')

@section('title', 'Answer Quiz')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Quiz: {{ $completion->quiz->name }}</h1>
    <form action="{{ route('completion.submit', $completion->id) }}" method="POST">
        @csrf
        <!-- Відображення питань -->
        @foreach ($completion->quiz->questions as $question)
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <h2 class="text-lg font-semibold mb-4">{{ $question->question }}</h2>

                @if ($question->type_id == 1)
                    <!-- Text -->
                    <input type="text" name="answers[{{ $question->id }}]" class="w-full p-2 border rounded-lg"
                        placeholder="Enter your answer">
                @elseif ($question->type_id == 2)
                    <!-- Single Choice -->
                    @foreach ($question->answers as $answer)
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->answer }}"
                                    class="form-radio">
                                <span class="ml-2">{{ $answer->answer }}</span>
                            </label>
                        </div>
                    @endforeach
                @elseif ($question->type_id == 3)
                    <!-- Multiple Choice -->
                    @foreach ($question->answers as $answer)
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $answer->answer }}"
                                    class="form-checkbox">
                                <span class="ml-2">{{ $answer->answer }}</span>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach

        <!-- Кнопка Submit -->
        <div class="flex justify-center">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                Submit
            </button>
        </div>
    </form>
@endsection
