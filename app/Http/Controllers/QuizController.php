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
        
        $quiz = Quiz::create(['name' => 'Some quiz', 'description' => 'Some description']);
        return redirect()->route('quizzes.edit', ['quiz' => $quiz->id]);
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
        //$questionTypes = \App\Models\QuestionType::all();
        //return view('quizzes.quiz', compact('quiz', 'questionTypes'));
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

    // ToDo to process into thin
    {
        try {
            $validatedData = $request->validate([
                'quiz-name' => 'required',
                'quiz-description' => 'required',
                'questions' => 'required|array',
                'questions.*.question' => 'required|string',
                'questions.*.type_id' => 'required|integer',
                'questions.*.answers' => 'nullable|array',
                'questions.*.answers.*' => 'required|string',
            ]);
       
            $quiz->update([
                'name' => $validatedData['quiz-name'],
                'description' => $validatedData['quiz-description']
            ]);
    
            $processedQuestionIds = [];
    
      
            foreach ($validatedData['questions'] as $questionId => $questionData) {
                $question = $quiz->questions()->updateOrCreate(
                    ['id' => $questionId],
                    [
                        'quiz_id' => $quiz->id,
                        'question' => $questionData['question'],
                        'type_id' => $questionData['type_id'],
                    ]
                );
    
                $processedQuestionIds[] = $question->id;
    
                $processedAnswerIds = [];
    
                if (!empty($questionData['answers'])) {
                    foreach ($questionData['answers'] as $answerId => $answerText) {
                        $answer = $question->answers()->updateOrCreate(
                            ['id' => $answerId],
                            ['answer' => $answerText]
                        );
    
                        $processedAnswerIds[] = $answer->id;
                    }
                }
    
              
                $question->answers()->whereNotIn('id', $processedAnswerIds)->delete();
            }
           $quiz->questions()->whereNotIn('id', $processedQuestionIds)->each(function ($question) {
                $question->answers()->delete(); 
                $question->delete(); 
            });
              
            $amountQuestions = $quiz->questions()->count();
            $quiz->update(['amount_questions' => $amountQuestions]);
    
            return response()->json([
                'success' => true,
                'message' => 'Quiz updated successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(), 
            ], 422);
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
