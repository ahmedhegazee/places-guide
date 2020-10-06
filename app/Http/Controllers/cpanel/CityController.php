<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Route;

class CityController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Governorate $govern)
    {

        return view('cpanel.cities.create', compact('govern'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Governorate $govern)
    {
        $this->validate($request, [
            'name' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
        ]);
        $request->merge(['name'=>json_encode($request->get('name')),]);
        $govern->cities()->create($request->all());
        flash(__('messages.add'), 'success');
        return redirect()->route('government.show', compact('govern'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $govern, City $city)
    {
        return view('cpanel.cities.edit', compact('govern', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Governorate $govern, City $city)
    {
        $this->validate($request, [
            'name' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
        ]);
        $request->merge(['name'=>json_encode($request->get('name')),]);
        $city->update($request->all());
        flash(__('messages.update'), 'success');
        return redirect()->route('government.show', compact('govern'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $govern, City $city)
    {
        $check = $city->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}
