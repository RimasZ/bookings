<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {
        $counries = Country::all();

        return view('back.country.index', [
            'countries' => $counries
        ]);
    }

    public function create()
    {
        return view('back.country.create', [

        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'season' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        

        $id = Country::create([
            'title' => $request->title,
            'season' => $request->season,
        ])->id;


        return redirect()->route('countries-index');
    }


    public function edit(Country $country)
    {
        return view('back.countries.edit', [
            'country' => $country
        ]);
    }

    public function update(Request $request, Country $country)
    {
        $country->update([
            'title' => $request->title,
            'season' => $request->season,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries-index');
    }
}
