<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    protected $guarded = [];



    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
