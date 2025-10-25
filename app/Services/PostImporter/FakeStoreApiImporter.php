<?php

namespace App\Services\PostImporter;

use App\DataObjects\PostDataObject;
use Illuminate\Support\Facades\Http;

class FakeStoreApiImporter implements PostImporterInterface
{
    /**
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function import(): PostDataObject
    {
        $response = Http::get('https://fakestoreapi.com/products/'.rand(1, 20))->throw();

        if ($response->clientError()) {
            throw new \InvalidArgumentException('Something went wrong with the payload provided.');
        }

        return PostDataObject::fromFakeStoreApiResponse($response);
    }
}
