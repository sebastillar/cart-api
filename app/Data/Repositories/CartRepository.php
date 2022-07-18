<?php

namespace App\Data\Repositories;

use App\Data\Models\Cart;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartRepository implements EloquentRepositoryInterface
{
    public function find(int $id): Model
    {
        // TODO: Implement find() method.
    }

    public function findBy(string $column, int|string $value): Model
    {
        return Cart::where($column, $value)->first();
    }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    public function save(array $model): bool
    {
        // TODO: Implement save() method.
    }

    public function update(array $model): bool
    {
        // TODO: Implement update() method.
    }

    public function create(array $model): Model
    {
        // TODO: Implement create() method.
    }
}