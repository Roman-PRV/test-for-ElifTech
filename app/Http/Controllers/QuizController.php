<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::paginate(8);
        return view('quizzes.quizzes', compact('quizzes'));

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        $questionTypes = \App\Models\QuestionType::all();
        return view('quizzes.quiz', compact('quiz', 'questionTypes'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $questionTypes = \App\Models\QuestionType::all();
        return view('quizzes.quiz', compact('quiz', 'questionTypes'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
{
    // Валідація запиту
    $validatedData = $request->validate([
        'questions' => 'required|array',
        'questions.*.question' => 'required|string',
        'questions.*.type_id' => 'required|integer',
        'questions.*.answers' => 'nullable|array',
        'questions.*.answers.*' => 'required|string',
    ]);

    try {
        // Отримуємо всі існуючі питання вікторини
        $existingQuestions = $quiz->questions;

        // Масив для відстеження збережених ID питань
        $processedQuestionIds = [];

        // Обробка питань із запиту
        foreach ($validatedData['questions'] as $questionId => $questionData) {
            // Оновлення або створення питання
            $question = $quiz->questions()->updateOrCreate(
                ['id' => $questionId], // Шукаємо питання за ID
                [
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question'],
                    'type_id' => $questionData['type_id'],
                ]
            );

            // Відстежуємо ID оброблених питань
            $processedQuestionIds[] = $question->id;

            // Отримуємо існуючі відповіді для питання
            $existingAnswers = $question->answers;

            // Масив для відстеження збережених ID відповідей
            $processedAnswerIds = [];

            if (!empty($questionData['answers'])) {
                foreach ($questionData['answers'] as $answerId => $answerText) {
                    // Оновлення або створення відповіді
                    $answer = $question->answers()->updateOrCreate(
                        ['id' => $answerId], // Шукаємо відповідь за ID
                        ['answer' => $answerText]
                    );

                    // Відстежуємо ID оброблених відповідей
                    $processedAnswerIds[] = $answer->id;
                }
            }

            // Видалення відповідей, які не були в запиті
            $existingAnswers->whereNotIn('id', $processedAnswerIds)->each(function ($answer) {
                $answer->delete();
            });
        }

        // Видалення питань, які не були в запиті
        $existingQuestions->whereNotIn('id', $processedQuestionIds)->each(function ($question) {
            $question->answers()->delete(); // Видаляємо відповіді пов'язаного питання
            $question->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Quiz updated successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating the quiz.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Quiz $quiz)
{
    try {
        $quiz->delete();
        return response()->json([
            'success' => true,
            'message' => 'Quiz deleted successfully!',
        ]);
    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Failed to delete quiz.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    
}
