<?php

namespace App\Data\Repositories;

use App\Data\Models\Product;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements EloquentRepositoryInterface
{
    public function findBy(string $column, int|string $value): Model
    {
        return Product::where($column, $value)->firstOrFail();
    }

    public function update(Model $model, array $params): Model
    {
        return Product::upsert($params, ["asin"], ["name", "link", "price"]);
    }

    public function updateAll(array $models): bool
    {
        return Product::upsert($models, ["asin"], ["name", "link", "price"]);
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

    public function create(array $model): Model
    {
        // TODO: Implement create() method.
    }

    public function destroy(int $id): bool
    {
        // TODO: Implement destroy() method.
    }
}
