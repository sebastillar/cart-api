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
        return Item::whereId($id)->firstOrFail();
    }

    public function update(Model $model, array $params): Model
    {
        return tap($model)->update($params);
    }

    public function create(array $model): Model
    {
        return Item::create($model);
    }

    public function save(Model $model): bool
    {
        return $model->save();
    }

    public function destroy(int $id): bool
    {
        return Item::destroy($id);
    }

    public function findBy(string $column, int|string $value): Model
    {
        // TODO: Implement findBy() method.
    }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    public function updateAll(array $models): bool
    {
        // TODO: Implement updateAll() method.
    }
}
