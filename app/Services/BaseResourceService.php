<?php

namespace App\Services;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Services\Contracts\BaseResourceServiceInterface;
use App\Services\Contracts\CacheServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseResourceService implements BaseResourceServiceInterface
{
    public const TIME_TO_LIVE = 60 * 60; // 1 hour
    protected BaseRepositoryInterface $repository;
    protected CacheServiceInterface $cacheService;

    public function __construct(BaseRepositoryInterface $repository, CacheServiceInterface $cacheService)
    {
        $this->repository = $repository;
        $this->cacheService = $cacheService;

        $this->cacheService->setTimeToLive(self::TIME_TO_LIVE);
    }

    public function create(array $attributes): Model
    {
        return $this->repository->create($attributes);
    }

    public function find(int $id): Model
    {
        return $this->cacheService->loadItem($this->repository, $id);
    }

    public function findOrFail(int $id): Model
    {
        return $this->repository->findOrFail($id);
    }

    public function delete(int $id): bool
    {
        $this->cacheService->forget($this->repository, $id);

        return $this->repository->delete($id);
    }

    public function update(int $id, array $attributes): bool
    {
        $this->cacheService->forget($this->repository, $id);

        return $this->repository->update($id, $attributes);
    }

    public function paginate(int $page = 1, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($page, $perPage);
    }

    public function forUser(int $userId): static
    {
        $this->repository->forUser($userId);

        return $this;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
