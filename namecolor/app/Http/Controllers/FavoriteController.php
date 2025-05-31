<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return Favorite::all(); // You can scope to user if needed later
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'word_id' => 'required|exists:words,id',
        ]);

        $favorite = Favorite::firstOrCreate([
            'word_id' => $validated['word_id'],
        ]);

        return response()->json($favorite, 201);
    }

    public function destroy($word_id)
    {
        Favorite::where('word_id', $word_id)->delete();
        return response()->json(['message' => 'Favorite removed']);
    }
}
