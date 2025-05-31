<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FinnfastService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.finnfast.base_url');
        $this->apiKey = config('services.finnfast.api_key');
    }

    public function getRandomWord()
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'accept' => 'application/json',
        ])->get("{$this->baseUrl}/words", [
            'limit' => 1,
            'page' => 1,
            'all' => false,
        ]);

        Log::info('Finnfast response status: ' . $response->status());
        Log::info('Finnfast response body: ' . $response->body());

        if ($response->successful()) {
            $data = $response->json();

            $words = $data['words'] ?? [];

            if (!empty($words) && isset($words[0])) {
                $word = $words[0];
                if (isset($word['finnish']) && isset($word['english'])) {
                    return $word;
                }
                throw new \Exception('Word missing required fields');
            }
            throw new \Exception('No words found in response');
        }

        throw new \Exception('Failed to fetch word from finnfast.fi');
    }
}
