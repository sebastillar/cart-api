<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\Order
 *
 * @property int $id
 * @property string $status
 * @property int $customer_id
 * @property float $subtotal_amount
 * @property float $shipment_amount
 * @property float $tax_amount
 * @property float $total_amount
 * @property mixed $items
 * @property mixed $billing_data
 * @property mixed $shipment_data
 * @property mixed $payment_data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereBillingData($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereCustomerId($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereItems($value)
 * @method static Builder|Order wherePaymentData($value)
 * @method static Builder|Order whereShipmentAmount($value)
 * @method static Builder|Order whereShipmentData($value)
 * @method static Builder|Order whereSubtotalAmount($value)
 * @method static Builder|Order whereTaxAmount($value)
 * @method static Builder|Order whereTotalAmount($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Customer $customer
 * @property-read int|null $items_count
 * @method static Builder|Order whereStatus($value)
 * @property int $status_id
 * @method static Builder|Order whereStatusId($value)
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = ["status", "customer_id", "subtotal_amount", "shipment_amount", "tax_amount", "total_amount"];

    protected $casts = [
        "shipment_data" => "array",
        "billing_data" => "array",
        "payment_data" => "array",
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function items(): MorphMany
    {
        return $this->morphMany(Item::class, "checkoutable");
    }
}
