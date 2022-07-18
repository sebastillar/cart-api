<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\Item
 *
 * @property int $id
 * @property int $quantity
 * @property string $product_id
 * @property int $checkoutable_id
 * @property string $checkoutable_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @method static Builder|Item whereCheckoutableId($value)
 * @method static Builder|Item whereCheckoutableType($value)
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereProductId($value)
 * @method static Builder|Item whereQuantity($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Model|\Eloquent $orderable
 * @property-read Product $product
 */
class Item extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $fillable = ["quantity", "product_id", "checkoutable_id", "checkoutable_type"];

    /**
     * Get all of the owning 'checkoutable' models.
     */
    public function checkoutable(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
