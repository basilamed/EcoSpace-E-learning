<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getCorrectAnswer()
    {
        return $this->answers()->where('correct', true)->first();
    }
}
