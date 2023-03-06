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

  public function getPlaces($search) {
    $client = new Client();

    $response = $client->request('GET', "{$this->url}/geocode/search?text=$search&apiKey={$this->key}", [
          'headers' => [
            'accept' => 'application/json',
          ],
    ]);

    return $response->getBody()->getContents();
      
  }
}