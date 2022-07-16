<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\OrderProduct
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property int $quantity
 * @property float|null $discount
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OrderProduct newModelQuery()
 * @method static Builder|OrderProduct newQuery()
 * @method static Builder|OrderProduct query()
 * @method static Builder|OrderProduct whereCreatedAt($value)
 * @method static Builder|OrderProduct whereDiscount($value)
 * @method static Builder|OrderProduct whereId($value)
 * @method static Builder|OrderProduct whereOrderId($value)
 * @method static Builder|OrderProduct whereProductId($value)
 * @method static Builder|OrderProduct whereQuantity($value)
 * @method static Builder|OrderProduct whereStatus($value)
 * @method static Builder|OrderProduct whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderProduct extends Model
{
    use HasFactory;

    protected $table = "order_products";

    protected $fillable = ["order_id", "product_id", "quantity", "discount", "status"];
}
