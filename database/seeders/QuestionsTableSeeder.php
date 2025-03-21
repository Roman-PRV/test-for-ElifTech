<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $quizes = DB::table('quizes')->get();


            $exampleQuestions = [
                'What is the capital of France?',
                'Who wrote "Hamlet"?',
                'What is the square root of 64?',
                'Which planet is closest to the Sun?',
                'What year did World War II end?',
            ];
    
            $questionTypes = DB::table('question_types')->pluck('id')->toArray();
    
            foreach ($quizes as $quiz) {
                foreach ($exampleQuestions as $question) {
                    DB::table('questions')->insert([
                        'quiz_id' => $quiz->id,
                        'question' => $question,
                        'type_id' => $questionTypes[array_rand($questionTypes)], 
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    }
}
