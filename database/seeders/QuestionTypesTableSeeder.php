<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('question_types')->insert([
            ['description' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'single choice', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'multiple choice', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
