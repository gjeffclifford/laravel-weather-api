<?php
namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class PlaceService {
  private $url;
  private $key;

  public function __construct()
  {
    $this->url = env("GEO_APIFY_DOMAIN");
    $this->key = env("GEO_APIFY_KEY");
  }

  public function getPlaces($search): string {
    $queryParams = $this->convertToQueryParams($search);
    $client = new Client();
    $response = $client->request('GET', "{$this->url}/geocode/search?$queryParams", [
          'headers' => [
            'accept' => 'application/json',
          ],
    ]);

    return $response->getBody()->getContents();
      
  }

  private function convertToQueryParams($search) {
    return http_build_query([
      'apiKey' => $this->key,
      'text' => $search,
    ]);
  }
}