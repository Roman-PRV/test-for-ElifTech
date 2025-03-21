@foreach ($answers as $answer)
    <div class="flex items-center space-x-4 mb-2">
        <input type="text" name="answers[{{ $answer->id }}]" value="{{ $answer->answer }}"
            class="flex-1 p-2 border rounded-lg" placeholder="Enter answer text" />

        <button type="button" class="remove-answer bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
            Remove answer
        </button>
        <button type="button" class="save-answer bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
            Save answer
        </button>
    </div>
@endforeach


<div class="mt-4 flex justify-center">
    <button type="button" class="add-answer-button bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
        Add Answer
    </button>
</div>
