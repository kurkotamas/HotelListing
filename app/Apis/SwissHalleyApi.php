<?php

namespace App\Apis;

use CodeIgniter\HTTP\CURLRequest;

class SwissHalleyApi
{
    protected CURLRequest $client;
    protected string $url = 'http://testapi.swisshalley.com/hotels/';

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest();
        $this->client->setHeader('X-API-KEY', getenv('SWISS_HALLEY_API_KEY'));
    }

    public function getOffersFromApi()
    {
        $response = $this->client->request('GET', $this->url);

        return json_decode($response->getBody(), true);
    }
}