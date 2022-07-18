<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\CartFactory;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\Cart
 *
 * @property int $id
 * @property int $customer_id
 * @property float $subtotal_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Cart newModelQuery()
 * @method static Builder|Cart newQuery()
 * @method static Builder|Cart query()
 * @method static Builder|Cart whereCreatedAt($value)
 * @method static Builder|Cart whereCustomerId($value)
 * @method static Builder|Cart whereId($value)
 * @method static Builder|Cart whereSubtotalAmount($value)
 * @method static Builder|Cart whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Customer $customer
 * @property-read Collection|Item[] $items
 * @property-read int|null $items_count
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "subtotal_amount"];

    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): MorphMany
    {
        return $this->morphMany(Item::class, "checkoutable");
    }
}
