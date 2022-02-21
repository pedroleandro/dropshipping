<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:3|max:191',
            'sku' => 'required',
            'inventory' => 'required',
            'price' => 'required',
            'photo' => 'image',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Por favor, informe um nome para o produto.",
            "name.min" => "O nome deve ter pelo menos 3 caracteres",
            "name.max" => "O nome deve ter pelo até 191 caracteres",
            "sku.required" => "Por gentileza, insira o SKU do produto.",
            "inventory.required" => "Informe o estoque desse produto.",
            "price.required" => "Por favor, insira o preço para esse produto."
        ];
    }
}
