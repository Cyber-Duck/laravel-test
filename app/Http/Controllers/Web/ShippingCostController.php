<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateShipmentCostRequest;
use App\Http\Transformers\ShipmentCostTransformer;
use App\Jobs\CreateShippingCost;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractalistic\ArraySerializer;

class ShippingCostController extends Controller
{
    public function index(Request $request)
    {
        $paginator = ShippingCost::latest()->paginate();
        $shippingCosts = $paginator->getCollection();
        return view(
            'shipping_partners',
            [
                'shippingCosts' => fractal($shippingCosts, new ShipmentCostTransformer)
                    ->serializeWith(new ArraySerializer)
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray(),
            ]
        );
    }

    public function create(CreateShipmentCostRequest $request)
    {
        dispatch_sync(new CreateShippingCost($request['cost']));
        return redirect()->intended('/shipping-partners');
    }
}
