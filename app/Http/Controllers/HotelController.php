<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Photos;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class HotelController extends Controller
{

    public function index()
    {
        $hotels = Hotel::all();
        $countries = Country::all();
        return view('back.hotel.index', [
            'hotels' => $hotels,
            'countries' => $countries
        ]);
    }


    public function create()
    {
        $countries = Country::all();
        
        return view('back.hotel.create', [
            'countries' => $countries
        ]);
    }

    public function countries(Request $request){

    }


    public function store(Request $request, Hotel $hotel)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'price' => 'required|integer|min:50',
            'photo' => 'sometimes|required|image',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $photo = $request->photo;
        if ($photo) {
            $name = $hotel->savePhoto($photo);
        }
        $id = Hotel::create([
            'title' => $request->title,
            'price' => $request->price,
            'duration' => $request->duration,
            'photo' => $name ?? null,
            'country_id' =>$request->country_id
        ])->id;


        return redirect()->route('hotels-index');
    }


    public function show(Hotel $hotel)
    {
        //
    }


    public function edit(Hotel $hotel)
    {
        //
    }


    public function update(Request $request, Hotel $hotel)
    {
        //
    }


    public function destroy(Hotel $hotel)
    {
        //
    }
}
