<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Services\FinnfastService;
use Illuminate\Http\Request;

class WordController extends Controller
{
    protected $finnfast;

    public function __construct(FinnfastService $finnfast)
    {
        $this->finnfast = $finnfast;
    }

    /**
     * Fetch 10 words live from Finnfast API.
     */

    public function fetchRandom(FinnfastService $finnfast)
    {
        try {
            $wordData = $finnfast->getRandomWord();

            $word = Word::create([
                'finnish' => $wordData['finnish'],
                'english' => $wordData['english'],
                'part_of_speech' => $wordData['part_of_speech'] ?? null,
                'example' => $wordData['example'] ?? null,
            ]);

            return response()->json($word, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function index()
    {
        try {
            $words = [];
            for ($i = 0; $i < 10; $i++) {
                $words[] = $this->finnfast->getRandomWord();
            }
            return response()->json($words);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch words: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'finnish' => 'required|string|max:255',
            'english' => 'required|string|max:255',
            'example' => 'nullable|string',
        ]);

        $word = Word::create($validated);
        return response()->json($word, 201);
    }

    public function show($id)
    {
        return Word::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $word = Word::findOrFail($id);

        $validated = $request->validate([
            'finnish' => 'sometimes|string|max:255',
            'english' => 'sometimes|string|max:255',
            'example' => 'nullable|string',
        ]);

        $word->update($validated);
        return response()->json($word);
    }

    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        $word->delete();
        return response()->json(null, 204);
    }
}
