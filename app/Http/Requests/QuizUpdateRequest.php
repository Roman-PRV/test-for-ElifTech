<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'quiz-name' => 'required|string|max:255',
            'quiz-description' => 'required|string|max:1000',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string|max:500',
            'questions.*.type_id' => 'required|integer',
            'questions.*.answers' => 'nullable|array',
            'questions.*.answers.*' => 'required|string|max:255',
        ];
    }

}
