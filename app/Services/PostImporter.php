<?php

namespace App\Services;

use App\Services\PostImporter\FakeStoreApiImporter;
use App\Services\PostImporter\JsonPlaceholderImporter;
use Illuminate\Support\Manager;

class PostImporter extends Manager
{
    const JSON_PLACEHOLDER = 'json_placeholder';

    const FAKE_STORE_API = 'fake_store_api';

    public function getDefaultDriver()
    {
        return self::JSON_PLACEHOLDER;
    }

    public function createJsonPlaceholderDriver()
    {
        return new JsonPlaceholderImporter();
    }

    public function createFakeStoreApiDriver()
    {
        return new FakeStoreApiImporter();
    }
}
