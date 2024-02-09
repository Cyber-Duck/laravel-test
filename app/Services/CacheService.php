<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CacheService
{
    public function store(string $key, $data, int $expirationMinutes = null)
    {
        // Retrieve existing data from cache
        $existingData = Cache::get($key, []);

        // Append new data to existing dataset
        $existingData[] = $data;

        // Store the updated dataset in cache with optional expiration
        if ($expirationMinutes !== null) {
            Cache::put($key, $existingData, Carbon::now()->addMinutes($expirationMinutes));
        } else {
            Cache::forever($key, $existingData);
        }
    }

    public function retrieve(string $key)
    {
        return Cache::get($key);
    }
}