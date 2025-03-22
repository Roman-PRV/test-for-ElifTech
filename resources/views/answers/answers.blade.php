@foreach ($answers as $answer)
    @include('answers.answer', ['answer' => $answer])
@endforeach


<div id="add-answer-button-container-{{ $question->id }}" class="mt-4 flex justify-center">
    <button type="button" class="add-answer-button bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
        Add Answer
    </button>
</div>
