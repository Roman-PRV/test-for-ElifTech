<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        // Отримуємо всі Quiz
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            for ($i = 1; $i <= 10; $i++) {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => "Question $i", 
                    'type_id' => rand(1, 3),   
                ]);
            }
        }
    }
}
