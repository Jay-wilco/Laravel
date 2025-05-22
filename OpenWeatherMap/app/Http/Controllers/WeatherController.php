<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CallApiService;

class WeatherController extends Controller
{
    protected CallApiService $apiService;

    public function __construct(CallApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $city = $request->query('city', '');
        $weatherData = [];
        $error = null;

        if (!empty($city)) {
            try {
                $weatherData = $this->apiService->getWeather($city);

                if (empty($weatherData)) {
                    $error = 'City not found or API error.';
                }
            } catch (\Exception $e) {
                $error = 'Error fetching weather data: ' . $e->getMessage();
            }
        }

        return view('weather', [
            'city' => $city,
            'weatherData' => $weatherData,
            'error' => $error,
        ]);
    }
}
