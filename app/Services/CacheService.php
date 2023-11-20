<?php

namespace App\Services;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Services\Contracts\CacheServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CacheService implements CacheServiceInterface
{

    private int $timeToLive;

    public function setTimeToLive(int $timeToLive): void
    {
        $this->timeToLive = $timeToLive;
    }

    public function loadItem(BaseRepositoryInterface $repository, int $id)
    {
        $key = $this->getKey($repository->getModel(), $id);

        if (!Cache::has($key)) {

            return Cache::remember($key, $this->timeToLive, function () use ($repository, $id) {

                return $repository->find($id);

            });

        }

        return Cache::get($key);
    }

    public function forget(BaseRepositoryInterface $repository, string $id): void
    {
        $key = $this->getKey($repository->getModel(), $id);

        if (Cache::has($key)) {
            Cache::forget($key);
        }
    }

    public function getKey(string $model, int $id): string
    {
        return Str::lower($model). "_{$id}";
    }
}
