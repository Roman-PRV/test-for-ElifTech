<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 25; $i++) {
            Quiz::create([
                'name' => "Quiz $i",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.',
                'amount_questions' => 10,
                'amount_completions' => 0,
            ]);
        }
    }
}