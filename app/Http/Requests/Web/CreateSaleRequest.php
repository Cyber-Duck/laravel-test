<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\PaginatesRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'coffee_type' => 'required|int|exists:coffee_types,id',
            'quantity' => 'required|int|min:1',
            'unit_cost' => 'required|numeric|min:0.01',
            'selling_price' => 'required|numeric|min:0.01'
        ];
    }
}
