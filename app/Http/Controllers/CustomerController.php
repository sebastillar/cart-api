<?php

namespace App\Http\Controllers;

use App\Features\UpdateBillingAddressFeature;
use App\Features\UpdatePaymentMethodFeature;
use App\Features\UpdateShippingAddressFeature;
use Lucid\Units\Controller;

class CustomerController extends Controller
{
    public function updateShipmentAddress($customer_id)
    {
        return $this->serve(UpdateShippingAddressFeature::class);
    }

    public function updateBillingAddress($customer_id)
    {
        return $this->serve(UpdateBillingAddressFeature::class);
    }

    public function updatePaymentMethod($customer_id)
    {
        return $this->serve(UpdatePaymentMethodFeature::class);
    }
}
