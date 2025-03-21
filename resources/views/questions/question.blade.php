<div class="bg-white rounded-lg shadow-md p-4 mb-6" data-question-id="{{ $question->id }}">
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex flex-wrap sm:flex-nowrap items-center gap-4">

            <input type="text" name="question" value="{{ $question->question }}" class="flex-1 p-2 border rounded-lg"
                placeholder="Enter question text" />


            <select name="type_id" class="p-2 border rounded-lg w-full sm:w-1/3 type-select"
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

            <button type="submit"
                class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 save-question-button">
                Save Question
            </button>
        </div>
    </form>


    @if ($question->type_id == 2 || $question->type_id == 3)
        <div id="answers-container-{{ $question->id }}" class="mt-4">
            @include('answers.answers', ['answers' => $question->answers])
        </div>
    @endif
</div>
