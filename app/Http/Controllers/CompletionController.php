<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Completion;
use App\Models\CompletionAnswer;
use App\Models\CompletionQuestion;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompletionController extends Controller
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
            // Валідація даних запиту
            $validated = $request->validate([
                'quiz_id' => 'required|exists:quizes,id',
            ]);
    
            // Знаходимо вікторину за ID
            $quiz = Quiz::findOrFail($validated['quiz_id']);
    
            // Створюємо новий Completion
            $completion = Completion::create([
                'quiz_id' => $quiz->id,
                'user_id' => auth()->id()??1, // Використовується ID авторизованого користувача
                'start' => now(),   // Поточна дата і час
            ]);
    
            // Повертаємо JSON-відповідь про успіх
            return response()->json([
                'success' => true,
                'completion_id' => $completion->id,
            ]);
        } catch (\Exception $e) {
            // Повертаємо JSON-відповідь про помилку
            return response()->json([
                'success' => false,
                'message' => 'Failed to create completion.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Completion $completion)
    {

        $date1 = Carbon::parse($completion->start); 
        $date2 = Carbon::parse($completion->finish); 
        $differenceInMinutes = $date1->diffInMinutes($date2);

        return view('completions.completion_show',compact('completion','differenceInMinutes'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Completion $completion)
    {
        return view('completions.completion_edit', compact('completion'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Completion $completion)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
    
        ]);
    
        try {
    
            $completion->update(['finish'=>now()]);
            foreach ($completion->quiz->questions as $question) {
                            
                if (isset($validated['answers'][$question->id])) {
                
                    $answerValue = $validated['answers'][$question->id];
                    $completionQuestion = CompletionQuestion::create([
                        'completion_id' => $completion->id,
                        'question_description' => $question->question,
                    ]);
                    
    
                    if (is_array($answerValue)) {
                        foreach ($answerValue as $answer) {
    
                            CompletionAnswer::create([
                                'completion_question_id' => $completionQuestion->id,
                                'answer' => $answer ,
                            ]);
                        }
                    } else {
                        CompletionAnswer::create([
                            'completion_question_id' => $completionQuestion->id,
                            'answer' => $answerValue,
                        ]);
                    }
                }
            }
    
            return redirect()->route('completions.show', $completion->id)
                             ->with('success', 'Quiz completed successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while saving your responses.',
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Completion $completion)
    {
        //
    }

    public function submit(Request $request, Completion $completion)
    {
   
}

}
