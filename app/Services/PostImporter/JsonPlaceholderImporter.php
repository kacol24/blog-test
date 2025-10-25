<?php

namespace App\Services\PostImporter;

use App\DataObjects\PostDataObject;
use Illuminate\Support\Facades\Http;

class JsonPlaceholderImporter implements PostImporterInterface
{
    /**
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function import(): PostDataObject
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/'.rand(1, 100))->throw();

        if ($response->clientError()) {
            throw new \InvalidArgumentException('Something went wrong with the payload provided.');
        }

        return PostDataObject::fromJsonPlaceholderResponse($response);
    }
}
