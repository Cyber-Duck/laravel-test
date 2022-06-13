<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;

class RecordSales extends Component
{
    public $quantity, $unitCost, $sellingPrice;

    public $margin = 0.25;

    public $shippingCost = 10;

    protected $rules = [
        'quantity' => 'required|numeric|min:1',
        'unitCost' => 'required|numeric|min:0.01',
    ];

    public function updated()
    {
        $this->sellingPrice = null;

        if ($this->quantity && $this->unitCost) {
            $this->validate();

            $this->sellingPrice = round((($this->unitCost * $this->quantity)  / ( 1 - $this->margin ) ) + $this->shippingCost, 2);
        }
    }

    public function submit()
    {
        $this->validate();

        Sale::recordSale($this->quantity, $this->unitCost, $this->sellingPrice);

        $this->quantity = null;
        $this->unitCost = null;
        $this->sellingPrice = null;
    }

    public function render()
    {
        $sales = Sale::latest()
            ->get();

        return view('livewire.record-sales', compact('sales'));
    }
}
