<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request) {
        return 'Store Favorite';
    }

    public function destroy(Request $request) {
        return 'Destroy favorite';
    }
}
