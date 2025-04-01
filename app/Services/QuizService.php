<?php
namespace App\Services;

use App\Models\Quiz;

class QuizService
{
    public function updateQuiz(Quiz $quiz, array $data)
    {
        $quiz->update([
            'name' => $data['quiz-name'],
            'description' => $data['quiz-description'],
        ]);

        $processedQuestionIds = [];

        foreach ($data['questions'] as $questionId => $questionData) {
            $question = $quiz->questions()->updateOrCreate(
                ['id' => $questionId],
                [
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question'],
                    'type_id' => $questionData['type_id'],
                ]
            );

            $processedQuestionIds[] = $question->id;

            $processedAnswerIds = [];

            if (!empty($questionData['answers'])) {
                foreach ($questionData['answers'] as $answerId => $answerText) {
                    $answer = $question->answers()->updateOrCreate(
                        ['id' => $answerId],
                        ['answer' => $answerText]
                    );

                    $processedAnswerIds[] = $answer->id;
                }
            }

            $question->answers()->whereNotIn('id', $processedAnswerIds)->delete();
        }

        $quiz->questions()->whereNotIn('id', $processedQuestionIds)->each(function ($question) {
            $question->answers()->delete();
            $question->delete();
        });
        
        $quiz->update(['amount_questions' => $quiz->questions()->count()]);
    }
}
