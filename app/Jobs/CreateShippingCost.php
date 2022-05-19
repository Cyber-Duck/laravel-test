<?php

namespace App\Jobs;

use App\Models\ShippingCost;

class CreateShippingCost
{
    public function __construct(private float $cost)
    {
    }

    public function handle(): void
    {
        (new ShippingCost([
            'cost' => $this->cost,
            'active' => true,
        ]))->saveOrFail();

        // only set others as inactive if save doesn't fail we'll do this by looking up latest and then bulk marking inactive
        // as opposed to getting all records and skipping latest and inactive one by one (n+1 query problem)
        $latest = ShippingCost::latest()->first()->id;
        ShippingCost::where('id', '!=', $latest)->update(['active' => false]);

    }
}
