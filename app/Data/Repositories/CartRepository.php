<?php

namespace App\Data\Repositories;

use App\Data\Models\Cart;
use App\Interfaces\EloquentAssociateRepository;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartRepository implements EloquentRepositoryInterface, EloquentAssociateRepository
{
    public function findBy(string $column, int|string $value): Model
    {
        return Cart::where($column, $value)->first();
    }

    public function update(Model $model, array $params): Model
    {
        $model->update($params);
        return $model;
    }

    public function find(int $id): Model
    {
        // TODO: Implement find() method.
    }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
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

    public function associateItem(Model $cart, Model $item)
    {
        return $cart->items()->save($item);
    }

    public function save(Model $model): bool
    {
        // TODO: Implement save() method.
    }
}
