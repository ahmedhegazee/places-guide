<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'category' => ['sometimes', 'numeric', Rule::in(Category::all()->pluck('id')->toArray())],
            'city' => ['sometimes', 'numeric', Rule::in(City::all()->pluck('id')->toArray())],
            'blood' => ['sometimes', 'numeric', Rule::in(BloodType::all()->pluck('id')->toArray())],
            // 'search' => 'sometimes|string'
        ]);
        $records = DonationRequest::with('client')->with('city.government')->with('bloodType')->search($request->search)
            ->searchBloodType($request->blood)
            ->searchCity($request->city)
            ->paginate(10);
        return view('donation-requests.index', compact('records'));
    }

    /**
     * Display the specified resource.
     *
     * @param  DonationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(DonationRequest $request)
    {
        return view('donation-requests.show', compact('request'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DonationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationRequest $request)
    {
        $check = $request->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}