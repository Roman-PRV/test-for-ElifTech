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
        //
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
