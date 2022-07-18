<?php

namespace App\Data\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Data\Models\Customer
 *
 * @property int $id
 * @property mixed|null $shipment_address
 * @property mixed|null $billing_address
 * @property mixed|null $payment_method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereBillingAddress($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer wherePaymentMethod($value)
 * @method static Builder|Customer whereShipmentAddress($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Cart|null $cart
 */
class Customer extends Model
{
    use HasFactory;

    protected $fillable = ["shipment_address", "billing_address", "payment_method"];

    protected $casts = [
        "shipment_address" => "array",
        "billing_address" => "array",
        "payment_method" => "array",
    ];

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
}
