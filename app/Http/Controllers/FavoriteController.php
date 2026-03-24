<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Question;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request, Question $question) {
        Favorite::firstOrCreate([
            'user_id' => $request->user()->id,
            'question_id' => $question->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Question $question) {
        Favorite::where('user_id', $request->user()->id)->where('question_id', $question->id)->delete();

        return back();
    }
}
