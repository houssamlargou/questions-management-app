<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    public function index(){
        $questions = \App\Models\Question::with('favorites')->latest()->get();
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
        $question = \App\Models\Question::with(['user', 'answers.user', 'favorites'])->findOrFail($id);
        return view('questions.show',compact('question'));
    }

    public function edit(\App\models\Question $question) {
        abort_if(auth()->id() !== $question->user_id,403);
        return view('questions.edit', compact('question'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Question $question) {
        abort_if(auth()->id() !== $question->user_id, 403);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $question->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);
        return redirect()->route('questions.show', $question->id);
    }
}
