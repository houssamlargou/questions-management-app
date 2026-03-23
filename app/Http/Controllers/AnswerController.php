<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question){
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        Answer::create([
            'user_id' => $request->user()->id,
            'question_id' => $question->id,
            'body' => $validated['body'],
        ]);

        return back();

    }
}
