<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        try {

            $answer = Answer::create([
                'question_id' => $request->input('question_id'),
                'answer' => 'Some text'
            ]);
            $html = view('answers.answer', compact('answer'))->render();
    
            return response()->json([
                'success' => true,
                'message' => 'Answer created successfully!',
                'html' => $html,
                'answerId' => $answer->id 
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create answer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        try {
            $answer->update([
                'answer' => $request->input('answer'),
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Answer updated successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update answer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        try {
            $answer->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Answer deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete answer.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }
    

    
}
