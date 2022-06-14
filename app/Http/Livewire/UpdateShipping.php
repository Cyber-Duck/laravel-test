<?php

namespace App\Http\Livewire;

use App\Models\Shipping;
use Livewire\Component;

class UpdateShipping extends Component
{
    public $shipping;

    protected $rules = [
        'shipping' => 'required|numeric|min:0.01',
    ];

    public function submit()
    {
        $this->validate();

        Shipping::create([
            'cost' => $this->shipping
        ]);

        $this->shipping = null;
    }

    public function render()
    {
        $shippings = Shipping::latest()
            ->get();

        return view('livewire.update-shipping', compact('shippings'));
    }
}
