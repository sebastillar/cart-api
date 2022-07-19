<?php

namespace App\Data\Repositories;

use App\Data\Models\Item;
use App\Data\Models\Product;
use App\Interfaces\EloquentAssociateRepository;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements EloquentRepositoryInterface, EloquentAssociateRepository
{
    public function findBy(string $column, int|string $value): Model
    {
        return Product::where($column, $value)->firstOrFail();
    }

    public function update(Model $model, array $params): Model
    {
        //TODO:
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

    public function create(array $model): Model
    {
        // TODO: Implement create() method.
    }

    public function destroy(int $id): bool
    {
        // TODO: Implement destroy() method.
    }

    public function associateItem(Model $product, Model $item)
    {
        $item->subtotal_item = $item->quantity * $product->price;
        return $product->items()->save($item);
    }

    public function save(Model $model): bool
    {
        // TODO: Implement save() method.
    }
}
