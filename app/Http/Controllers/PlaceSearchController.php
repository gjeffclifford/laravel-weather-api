<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlaceService;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Get;

class PlaceSearchController extends Controller
{
    #[Get('api/place')]
    public function __invoke(Request $request): Response {
        $placeService = new PlaceService();
        $response = $placeService->getPlaces($request->keyword);
        return new Response($response, 200);
    }
}
