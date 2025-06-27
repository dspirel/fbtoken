<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;

class StorageService
{
    private Storage $storage;

    public function __construct(string $firebaseCredentials)
    {
        $credentialsArray = json_decode($firebaseCredentials, true);
        $this->storage = (new Factory)
            ->withServiceAccount($credentialsArray)
            ->createStorage();
    }

    public function getBucket()
    {
        return $this->storage->getBucket();
    }
}
