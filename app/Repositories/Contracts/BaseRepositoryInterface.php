<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{

    public function paginate(int $page = 1, int $perPage = 12, array $columns = ['*']): LengthAwarePaginator;

    public function create($attributes): Model;

    public function find(int $id): Model;

    public function findOrFail(int $id): Model;

    public function update(int $id, $attributes): bool;

    public function delete(int $id): bool;

    public function forUser(int $userId);

    public function with(array|string $relations);

    public function getModel();

}
