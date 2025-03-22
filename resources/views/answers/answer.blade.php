<div class="flex items-center space-x-4 mb-2" data-answer-id="{{ $answer->id }}">
    <input type="text" name="questions[{{ $answer->question_id }}][answers][{{ $answer->id }}]"
        value="{{ $answer->answer }}" class="flex-1 p-2 border rounded-lg" placeholder="Enter answer text" />

    <button type="button" class="remove-answer-button bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
        Remove answer
    </button>

</div>
