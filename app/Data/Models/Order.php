<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\Order
 *
 * @property int $id
 * @property string $status
 * @property int|null $customer_id
 * @property float $subtotal_amount
 * @property float $shipment_amount
 * @property float $tax_amount
 * @property float $total_amount
 * @property int|null $shipment_id
 * @property array|null $shipment_data
 * @property int|null $billing_id
 * @property array|null $billing_data
 * @property int|null $payment_id
 * @property array|null $payment_data
 * @property array|null $notification_events
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Customer|null $customer
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereBillingData($value)
 * @method static Builder|Order whereBillingId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereCustomerId($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereNotificationEvents($value)
 * @method static Builder|Order wherePaymentData($value)
 * @method static Builder|Order wherePaymentId($value)
 * @method static Builder|Order whereShipmentAmount($value)
 * @method static Builder|Order whereShipmentData($value)
 * @method static Builder|Order whereShipmentId($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereSubtotalAmount($value)
 * @method static Builder|Order whereTaxAmount($value)
 * @method static Builder|Order whereTotalAmount($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = ["created_at", "updated_at"];

    protected $casts = [
        "shipment_data" => "array",
        "billing_data" => "array",
        "payment_data" => "array",
        "notification_events" => "array",
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }
}
