<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AnswerController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function getCorrectAnswerIndices($questionId)
    {
        $correctAnswer = Answer::where('question_id', $questionId)
            ->where('correct', true)
            ->get();
            
        return response()->json($correctAnswer);
    }
}
