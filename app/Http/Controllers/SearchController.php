<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('q');
        $questions = Question::with('favorites')
            ->when($query, function ($builder) use ($query) {
                $builder->where(function ($subQuery) use ($query) {
                    $subQuery->where('title', 'like', '%' . $query . '%')
                             ->orWhere('body', 'like', '%' . $query . '%');
                });
            })
            ->latest()
            ->get();
        
        return view('questions.index', compact('questions','query'));
    }
}
 