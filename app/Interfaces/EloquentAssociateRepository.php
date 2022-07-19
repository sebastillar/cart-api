<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface EloquentAssociateRepository
{
    public function associateItem(Model $modelHas, Model $modelBelongs);
}
