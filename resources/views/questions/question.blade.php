<div class="bg-white rounded-lg shadow-md p-4 mb-6" data-question-id="{{ $question->id }}">


    <div class="flex flex-wrap sm:flex-nowrap items-center gap-4">
        <input type="text" name="questions[{{ $question->id }}][question]" value="{{ $question->question }}"
            class="flex-1 p-2 border rounded-lg" placeholder="Enter question text" />


        <select name="questions[{{ $question->id }}][type_id]" class="p-2 border rounded-lg w-full sm:w-1/3 type-select"
            data-question-id="{{ $question->id }}">
            @foreach ($questionTypes as $type)
                <option value="{{ $type->id }}" {{ $question->type_id == $type->id ? 'selected' : '' }}>
                    {{ $type->description }}
                </option>
            @endforeach
        </select>


        <button type="button"
            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 remove-question-button">
            Remove question
        </button>

    </div>


    <div id="answers-container-{{ $question->id }}" class="mt-4 {{ $question->type_id == 1 ? 'hidden' : '' }}">
        @include('answers.answers', ['answers' => $question->answers])
    </div>



</div>
