<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\PaginatesRequest;
use Illuminate\Foundation\Http\FormRequest;

class ListSalesRequest extends FormRequest
{
    use PaginatesRequest;

    public function rules()
    {
        return ['page' => 'integer', 'per_page', 'integer'];
    }
}
