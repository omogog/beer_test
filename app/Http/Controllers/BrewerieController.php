<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrewerieResource;
use GuzzleHttp\Client as GuzzleClient;

class BrewerieController extends Controller
{
    private const EXTERNAL_ENDPOINT_URL = 'https://api.openbrewerydb.org/breweries';
    private const EXTERNAL_ENDPOINT_URL_SPECIFIC = 'https://api.openbrewerydb.org/breweries/%s';

    private $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
        return $this->getAll();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($id)
    {
        return $this->getCurrent($id);
    }

    /**
     * methods below stored in the same class for easy checking test
     */

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getAll()
    {
        $response = $this->client->get(self::EXTERNAL_ENDPOINT_URL);

        return BrewerieResource::collection(json_decode($response->getBody()));
    }

    /**
     * @param $id
     * @return BrewerieResource
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getCurrent($id)
    {
        $response = $this->client->get(sprintf(self::EXTERNAL_ENDPOINT_URL_SPECIFIC, $id));

        return new BrewerieResource(json_decode($response->getBody()));
    }
}
