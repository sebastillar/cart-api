<?php

namespace App\Domains\Order\Requests;

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
            "quantity" => "required|integer|min:1",
            "product.id" => "required|integer",
            "product.origin_identifier" => "sometimes|string",
            "product.title" => "required|string",
            "product.currency_iso" => "sometimes|string",
            "product.current_price" => "required|numeric|min:1",
            "product.discount" => "sometimes|integer|min:1",
        ];
    }
}
