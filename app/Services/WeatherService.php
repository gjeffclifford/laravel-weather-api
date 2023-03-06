<?php
namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class WeatherService {

  private $url;

  public function __construct()
  {
    $this->url = env("OPEN_WEATHER_APP_DOMAIN");
  }

  public function getWeather($request): string {
    $queryParams = $this->convertToQueryParams($request);

    $client = new Client();

    $response = $client->request('GET', "{$this->url}/forecast?{$queryParams}", [
          'headers' => [
            'accept' => 'application/json',
          ],
    ]);

    return $response->getBody()->getContents();
      
  }

  private function convertToQueryParams($request) {
    return http_build_query([
      'appid' => env("OPEN_WEATHER_APP_KEY"),
      'lat' => $request['lat'],
      'lon' => $request['lon'],
    ]);
  }
}