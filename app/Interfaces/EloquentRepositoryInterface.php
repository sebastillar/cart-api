<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function update(Model $model, array $params): Model;

    public function find(int $id): Model;

    public function findBy(string $column, int|string $value): Model;

    public function findAll(): Collection;

    public function save(Model $model): bool;

    public function updateAll(array $models): bool;

    public function create(array $model): Model;

    public function destroy(int $id): bool;
}
