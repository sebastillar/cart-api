<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Data\Models\Status
 *
 * @property int $id
 * @property string $description
 * @method static Builder|Status newModelQuery()
 * @method static Builder|Status newQuery()
 * @method static Builder|Status query()
 * @method static Builder|Status whereDescription($value)
 * @method static Builder|Status whereId($value)
 * @mixin Eloquent
 */
class Status extends Model
{
    use HasFactory;

    protected $table = "statuses";

    protected $fillable = ["description"];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
