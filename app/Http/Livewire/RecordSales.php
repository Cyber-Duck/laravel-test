<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class RecordSales extends Component
{
    public $product, $quantity, $unitCost, $sellingPrice;

    public $margin = 0.25;

    public $shippingCost = 10;

    protected $rules = [
        'product' => 'required|numeric|exists:products,id',
        'quantity' => 'required|numeric|min:1',
        'unitCost' => 'required|numeric|min:0.01',
    ];

    public function updated()
    {
        $this->sellingPrice = null;

        if ($this->product && $this->quantity && $this->unitCost) {
            $this->validate();

            $product = Product::findOrFail($this->product);

            $this->sellingPrice = round((($this->unitCost * $this->quantity)  / ( 1 - $product->margin ) ) + $this->shippingCost, 2);
        }
    }

    public function submit()
    {
        $this->validate();

        Sale::recordSale($this->product, $this->quantity, $this->unitCost, $this->sellingPrice);

        $this->product = null;
        $this->quantity = null;
        $this->unitCost = null;
        $this->sellingPrice = null;
    }

    public function render()
    {
        $products = Product::orderBy('name')
            ->pluck('name', 'id');

        $sales = Sale::latest()
            ->with('product')
            ->get();

        return view('livewire.record-sales', compact('products', 'sales'));
    }
}
