<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort ?? '';
        $hotels = Hotel::all();
        $countries = Country::all();

        $hotels = match($sort) {
            'name_asc' => $hotels->sortBy('title'),
            'name_desc' => $hotels->sortByDesc('title'),
            'price_asc' => $hotels->sortBy('price'),
            'price_desc' => $hotels->sortByDesc('price'),
            default => $hotels
        };

        $request->session()->put('last-client-view', [
            'sort' => $sort,
        ]);

        return view('front.index', [
            'hotels' => $hotels,
            'countries' => $countries,
            'sortSelect' => Hotel::SORT,
            'sort' => $sort,
        ]);
    }

    public function showHotel(Hotel $hotel)
    {
        $countries = Country::all();
        return view('front.hotel', [
            'hotel' => $hotel,
            'countries' => $countries
        ]);
    }

    public function orders(Request $request)
    {
        $orders = $request->user()->order;

        return view('front.orders', [
            'orders' => $orders,
            'status' => Order::STATUS
        ]);
    }
}
