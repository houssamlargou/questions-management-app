<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    public function index(){
        $questions = \App\Models\Question::latest()->get();
        return view('questions.index',compact('questions'));
    }

    public function create(){
        return view('questions.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string',
        ]);

        Question::create([
            'user_id'=>$request->user()->id,
            'title'=>$validated['title'],
            'body'=>$validated['body'],
        ]);

        return Redirect('/questions');
    }

    public function show(string $id){
        $question = \App\Models\Question::findOrFail($id);
        return view('questions.show',compact('question'));
    }
}
