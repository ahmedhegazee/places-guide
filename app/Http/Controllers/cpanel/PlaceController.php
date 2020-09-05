<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class placeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $records = Place::search($request->search)
        $records = Place::with(['owner', 'city.governorate', 'subCategory.category'])->paginate(10);
        // dd($records);
        return view('cpanel.places.index', compact('records'));
    }
    public function show(Place $place)
    {
        $place->preventClosedDaysAttribute = false;
        $place->owner->preventAccountTypeAttribute = false;
        // dd($place);
        return view('cpanel.places.show', compact('place'));
    }
}