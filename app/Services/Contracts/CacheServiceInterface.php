<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface CacheServiceInterface
{

    public function setTimeToLive(int $timeToLive): void;
    public function loadItem(BaseRepositoryInterface $repository, int $id);

    public function setItem(BaseRepositoryInterface $repository, $item);

    public function forget(BaseRepositoryInterface $repository, string $id): void;

    public function getKey(string $model, int $id): string;

}
