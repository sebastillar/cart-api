<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Data\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $asin
 * @property float $price
 * @property string $link
 * @property-read Collection|Item[] $items
 * @property-read int|null $items_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereAsin($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereLink($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
