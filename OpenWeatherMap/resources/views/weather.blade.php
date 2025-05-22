<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Weather App</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container">
        <h1>Weather App</h1>

        <form method="get" action="{{ route('weather') }}">
            <label class="label" for="city">Enter city name</label>
            <input type="text" name="city" id="city" class="input" placeholder="e.g., London"
                value="{{ $city }}" autocomplete="off" />
            <button type="submit" class="btn btn-default">Get Weather</button>
        </form>

        @if ($error)
            <div class="alert">
                {{ $error }}
            </div>
        @elseif (!empty($weatherData))
            <h2>Weather in {{ $weatherData['name'] }}</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Metric</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Temperature</td>
                        <td>{{ $weatherData['main']['temp'] }} °C</td>
                    </tr>
                    <tr>
                        <td>Feels Like</td>
                        <td>{{ $weatherData['main']['feels_like'] }} °C</td>
                    </tr>
                    <tr>
                        <td>Humidity</td>
                        <td>{{ $weatherData['main']['humidity'] }}%</td>
                    </tr>
                    <tr>
                        <td>Wind Speed</td>
                        <td>{{ $weatherData['wind']['speed'] }} m/s</td>
                    </tr>
                    <tr>
                        <td>Condition</td>
                        <td>{{ ucfirst($weatherData['weather'][0]['description']) }}</td>
                    </tr>
                </tbody>
            </table>

            <img class="weather-icon"
                src="http://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@2x.png"
                alt="Weather icon">
        @endif
    </div>

</body>

</html>
