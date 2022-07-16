<?php

namespace App\Domains\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Checkout extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "customer_id" => "sometimes|integer",
            "shipment_data" => "sometimes|array",
            "shipment_data.address" => "required|string",
            "shipment_data.country" => "required|string",
            "shipment_data.zip_code" => "required|string",
            "billing_data" => "sometimes|array",
            "billing_data.name" => "required|string",
            "billing_data.address" => "required|string",
            "billing_data.country" => "required|string",
            "payment_data" => "sometimes|array",
            "payment_data.method" => "required|array",
            "payment_data.method.name" => "required|string",
            "payment_data.method.method_type" => "required|string",
            "payment_data.method.customer_number" => "required|string",
        ];
    }
}
