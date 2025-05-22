<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CallApiService
{
    public function getWeather(string $city)
    {
        $apiKey = config('services.openweather.key');
        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
