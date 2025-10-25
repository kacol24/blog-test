<?php

namespace App\DataObjects;

use Illuminate\Http\Client\Response;

class PostDataObject
{
    public function __construct(
        public $title,
        public $content = '',
        public $status = 'draft',
        public $source = '',
        public $externalId = '',
    ) {
    }

    public static function fromJsonPlaceholderResponse(Response $response)
    {
        $data = $response->json();

        return new self(
            $data['title'],
            $data['body'],
            'draft',
            'JSON Placeholder',
            $data['id'],
        );
    }

    public static function fromFakeStoreApiResponse(Response $response)
    {
        $data = $response->json();

        return new self(
            $data['title'],
            $data['description'],
            'draft',
            'Fake Store Api',
            $data['id'],
        );
    }

    public function toArray()
    {
        return [
            'title'       => $this->title,
            'content'     => $this->content,
            'status'      => $this->status,
            'source'      => $this->source,
            'external_id' => $this->externalId,
        ];
    }
}
