<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = $request->user()->loadCount(['questions', 'favorites']);
        $user->load([
            'questions' => function($query) {
                $query->latest();
            },
            'favorites.question.user' => function ($query) {
                $query->latest();
            },
        ]);

        return view('profile.index', compact('user'));
    }
}
