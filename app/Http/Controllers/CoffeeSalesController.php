<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Sales1s;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoffeeSalesController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'dashboard',
        ]);
    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) { // echo "AAAA";die;
            $previous_sales = Sales::all();

            return view('coffee_sales', compact('previous_sales'));
        }

        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard2()
    {
        if (Auth::check()) {
            $previous_sales = Sales1s::all();

            return view('coffee_sales2', compact('previous_sales'));
        }
    }

    public function newsale(Request $request)
    {
        $input = $request->all();
        $cost = $input['qty'] * $input['cost'];
        $per = 1 - 0.25;
        $selling_price = ($cost / $per) + 10;
        Sales::create([
            'qty' => $input['qty'],
            'price' => $input['cost'],
            'selling_price' => round($selling_price, 2),
        ]);
        $previous_sales = Sales::all();

        return response()->json(['sp' => round($selling_price, 2), 'sale_data' => $previous_sales]);
    }

    public function newsale1(Request $request)
    {
        $input = $request->all();
        $cost = $input['qty'] * $input['cost'];
        if ($input['productval'] == 2) {
            $per = 1 - 0.25;
        } elseif ($input['productval'] == 1) {
            $per = 1 - 0.15;
        }
        $selling_price = ($cost / $per) + 10;
        Sales1s::create([
            'product' => $input['productname'],
            'qty' => $input['qty'],
            'price' => $input['cost'],
            'selling_price' => round($selling_price, 2),
        ]);
        $previous_sales = Sales1s::all();

        return response()->json(['sp' => round($selling_price, 2), 'sale_data' => $previous_sales]);
    }
}
