<?php

namespace App\Data\Repositories;

use App\Data\Models\Cart;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartRepository implements EloquentRepositoryInterface
{
    public function findBy(string $column, int|string $value): Model
    {
        return Cart::where($column, $value)->first();
    }

    public function update(Model $model, array $params): Model
    {
        return tap($model, function () use ($model, $params) {
            Cart::whereId($model->id)->update($params);
        });
    }

    public function find(int $id): Model
    {
        // TODO: Implement find() method.
    }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    public function save(array $model): bool
    {
        // TODO: Implement save() method.
    }

    public function updateAll(array $models): bool
    {
        // TODO: Implement updateAll() method.
    }

    public function create(array $model): Model
    {
        // TODO: Implement create() method.
    }

    public function destroy(int $id): bool
    {
        // TODO: Implement destroy() method.
    }
}
