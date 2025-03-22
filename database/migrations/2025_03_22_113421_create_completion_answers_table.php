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
        Schema::create('completion_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('completion_question_id')->unsigned();
            $table->text('answer');
            $table->timestamps();
            $table->foreign('completion_question_id')->references('id')->on('completion_questions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completion_answers');
    }
};
