<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\Product
 *
 * @property int $id
 * @property string $origin_identifier
 * @property string $title
 * @property float $price
 * @property mixed|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDetails($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereOriginIdentifier($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ["origin_identifier", "title", "details", "price"];

    protected $casts = [
        "details" => "array"
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
