<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateSaleRequest;
use App\Http\Requests\Web\ListSalesRequest;
use App\Http\Transformers\SaleTransformer;
use App\Jobs\CreateSale;
use App\Models\CoffeeType;
use App\Models\Sale;
use App\Providers\RouteServiceProvider;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractalistic\ArraySerializer;

class CoffeeSaleController extends Controller
{
    public function index(ListSalesRequest $request)
    {

        $coffeeTypes = CoffeeType::all();
        $paginator = Sale::paginate();
        $sales = $paginator->getCollection();

        return view(
            'coffee_sales',
            [
                'coffeeTypeOptions' => $coffeeTypes->mapWithKeys(fn($type) => [$type->id => $type->name]),
                'sales' => fractal($sales, new SaleTransformer)
                    ->serializeWith(new ArraySerializer)
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray(),
            ]
        );
    }

    public function create(CreateSaleRequest $request)
    {
        dispatch_sync(
            new CreateSale(
                $request->user()->id,
                $request['coffee_type'],
                $request['quantity'],
                $request['unit_cost'],
                $request['selling_price'],
            )
        );

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
