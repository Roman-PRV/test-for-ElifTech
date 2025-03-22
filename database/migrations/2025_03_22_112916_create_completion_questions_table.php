<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('completion_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('completion_id')->unsigned();
            $table->string('question_description');
            $table->timestamps();
            $table->foreign('completion_id')->references('id')->on('completions')->onDelete('cascade')->onUpdate('cascade');
                    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completion_questions');
    }
};
