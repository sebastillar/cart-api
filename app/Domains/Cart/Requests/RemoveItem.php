<?php

namespace App\Domains\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveItem extends FormRequest
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
            "item_id" => "required|integer",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(["customer_id" => $this->route("customer_id")]);
        $this->merge(["item_id" => $this->route("item_id")]);
    }
}
