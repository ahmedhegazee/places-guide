<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Government;
use Illuminate\Http\Request;

class CityController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Government $govern)
    {
        return view('cities.create', compact('govern'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Government $govern)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        $govern->cities()->create($request->all());
        flash('Added Successfully', 'success')->important();
        return redirect()->route('government.show', compact('govern'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(Government $govern, City $city)
    {
        return view('cities.edit', compact('govern', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Government $govern, City $city)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        $city->update($request->all());
        flash('Updated Successfully', 'success')->important();
        return redirect()->route('government.show', compact('govern'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Government $govern, City $city)
    {
        $check = $city->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}