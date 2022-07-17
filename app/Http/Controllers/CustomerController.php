<?php

namespace App\Http\Controllers;

use Lucid\Units\Controller;

class CustomerController extends Controller
{
    public function updateShipmentAddress($customer_id)
    {
        return $this->serve(new UpdateShippingAddressFeature());
    }

    public function updateBillingAddress($customer_id)
    {
        return $this->serve(new UpdateBillingAddressFeature());
    }

    public function updatePaymentMethod($customer_id)
    {
        return $this->serve(new UpdatePaymentMethodFeature());
    }
}
