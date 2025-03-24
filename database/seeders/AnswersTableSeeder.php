<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class AnswersTableSeeder extends Seeder
{
    public function run()
    {
        // Отримуємо всі питання
        $questions = Question::all();

        foreach ($questions as $question) {
            if (in_array($question->type_id, [2, 3])) {
                $numberOfAnswers = rand(2, 5);

                for ($i = 1; $i <= $numberOfAnswers; $i++) {
                    Answer::create([
                        'question_id' => $question->id, 
                        'answer' => "Answer $i",
                    ]);
                }
            }
        }
    }
}
