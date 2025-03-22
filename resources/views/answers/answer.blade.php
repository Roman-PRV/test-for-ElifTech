<div class="flex items-center space-x-4 mb-2" data-answer-id="{{ $answer->id }}">
    <input type="text" name="answers[{{ $answer->id }}]" value="{{ $answer->answer }}"
        class="flex-1 p-2 border rounded-lg" placeholder="Enter answer text" />

    <button type="button" class="remove-answer-button bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
        Remove answer
    </button>
    <button type="button" class="save-answer-button bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
        Save answer
    </button>
</div>
