<?php

namespace App\Data\Repositories;

use App\Data\Models\Order;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements EloquentRepositoryInterface
{
    public function update(Model $model, array $params): Model
    {
        return tap($model)->update($params);
    }

    public function find(int $id): Model
    {
        // TODO: Implement find() method.
    }

    public function findBy(string $column, int|string $value): Model
    {
        // TODO: Implement findBy() method.
    }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    public function save(Model $model): bool
    {
        // TODO: Implement save() method.
    }

    public function updateAll(array $models): bool
    {
        // TODO: Implement updateAll() method.
    }

    public function create(array $model): Model
    {
        return Order::create($model);
    }

    public function destroy(int $id): bool
    {
        // TODO: Implement destroy() method.
    }
}
