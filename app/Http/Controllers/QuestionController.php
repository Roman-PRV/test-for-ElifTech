<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
    
        $question->update([
            'question' => $request->input('question'),
            'type_id' => $request->input('type_id'),
        ]);
    
        return redirect()->back()->with('success', 'Question updated successfully!');
    }

    public function destroy(Question $question)
    {
      
        try {
            $question->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Question deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete question.',
                'error' => $e->getMessage()
            ], 500); 
        }
    }
}
