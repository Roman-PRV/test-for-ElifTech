<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quizes')->insert([
            [
                'name' => 'General Knowledge Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Test your general knowledge skills with this fun quiz.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Science Trivia',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Challenge yourself with science-based questions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'History Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Dive into the past with this history quiz.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Show off your knowledge about various sports.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Music Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 6,
                'description' => 'Test your music knowledge with this exciting quiz.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Movie Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'How well do you know movies? Find out here!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Geography Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Explore the world through geography questions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Literature Quiz',
                'amount_questions' => 9,
                'amount_competitions' => 0,
                'description' => 'Delve into the world of literature with this quiz.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Math Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Brush up on your math skills with this quiz.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Technology Quiz',
                'amount_questions' => 0,
                'amount_competitions' => 0,
                'description' => 'Stay ahead in the tech world with this quiz.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
