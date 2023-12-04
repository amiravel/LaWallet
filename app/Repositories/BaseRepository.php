<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    protected Builder $query;

    protected const TIME_TO_LIVE = 1 * 60; // 1 minute

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $this->model->newQuery();
    }

    public function create($attributes): Model
    {
        return $this->query->create($attributes);
    }

    public function find(int $id): Model
    {
        return $this->query->find($id);
    }

    public function findOrFail(int $id): Model
    {
        return $this->query->findOrFail($id);
    }

    public function update(int $id, $attributes): bool
    {
        return $this->query->where('id', $id)
            ->update($attributes);
    }

    public function delete(int $id): bool
    {
        return $this->query->where('id', $id)->delete();
    }

    public function forUser(int $userId): static
    {
        $this->query = $this->query->where('user_id', $userId);

        return $this;
    }

    public function paginate(int $page = 1, int $perPage = 12, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->query->paginate($perPage, $columns, 'page', $page);
    }

    public function with(array|string $relations)
    {
        $this->query->with($relations);

        return $this;
    }

    public function list(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->query->get();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function freshQuery():void
    {
        $this->query = $this->model->newQuery();
    }

}
