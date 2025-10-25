<?php

namespace App\Services\PostImporter;

use App\DataObjects\PostDataObject;

interface PostImporterInterface
{
    public function import(): PostDataObject;
}
