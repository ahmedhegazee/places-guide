<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:owners');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $place = auth('owners')->user()->place;
        $place->preventClosedDaysAttribute = false;
        $place->owner->preventAccountTypeAttribute = false;
        return view('owners.home', compact('place'));
    }
}