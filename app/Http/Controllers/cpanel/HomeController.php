<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countPlaces = Place::available()->get()->count();
        $countOwnerRequest = Place::whereHas('owner', function ($query) {
            $query->accepted(0);
        })->get()->count();
        $discountsCount = Discount::available()->count();
        return view('cpanel.home', compact('countPlaces', 'countOwnerRequest', 'discountsCount'));
    }
}