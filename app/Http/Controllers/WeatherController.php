<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Get;

class WeatherController extends Controller
{
    #[Get('api/weather')]
    public function __invoke(Request $request): Response {
        $placeService = new WeatherService();
        $response = $placeService->getWeather($request->all());
        return new Response($response, 200);
    }
}
