<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::all();
        if($request->user->role > 5){
            $orders = DB::table('orders')->where('user_id', '=', $request->user->id)->get();
        }
        return view('back.orders.index', [
            'orders' => $orders,
            'status' => Order::STATUS
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Order::create([
            'hotel' => $request->hotel,
            'user_id' => $request->user->user_id,
            'price' => $request->hotel->price,  
        ]);

        return redirect()->route('front-index');
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
