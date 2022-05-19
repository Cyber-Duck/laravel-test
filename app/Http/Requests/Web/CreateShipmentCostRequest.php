<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CreateShipmentCostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cost' => 'required|numeric|min:0.00',
        ];
    }
}
