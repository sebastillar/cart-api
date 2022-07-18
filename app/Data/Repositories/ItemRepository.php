<?php

namespace App\Data\Repositories;

use App\Data\Models\Item;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ItemRepository implements EloquentRepositoryInterface
{
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

    public function update(array $model): bool
    {
        // TODO: Implement update() method.
    }

    public function create(array $model): Model
    {
        $item = new Item(["quantity" => $model["quantity"]]);

        $item->product()->associate($model["product"]);
        $model["cart"]->items()->save($item);

        return tap($item, function () use ($item) {
            $item->save();
        });
    }

    public function save(array $model): bool
    {
        // TODO: Implement save() method.
    }
}
