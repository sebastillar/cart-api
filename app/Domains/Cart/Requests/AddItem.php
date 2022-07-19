<?php

namespace App\Domains\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "customer_id" => "required|integer|exists:customers,id",
            "item.quantity" => "required|integer|min:1",
            "item.product" => "required",
            "item.product.name" => "required|string",
            "item.product.asin" => "required|string",
            "item.product.price" => "required|numeric|min:1",
            "item.product.link" => "required|url",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(["customer_id" => $this->route("customer_id")]);
    }
}
