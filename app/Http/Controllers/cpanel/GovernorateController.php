<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Governorate::paginate(10);
        return view('cpanel.governorates.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        Governorate::create($request->all());
        flash(__('messages.add'), 'success');
        return redirect()->route('government.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Governorate  $government
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $government)
    {
        $records = $government->cities()->paginate(10);
        return view('cpanel.governorates.show', compact('records', 'government'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Governorate  $government
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $government)
    {
        return view('cpanel.governorates.edit', compact('government'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Governorate  $government
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Governorate $government)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        $government->update($request->all());
        flash(__('messages.update'), 'success');
        return redirect()->route('government.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Governorate  $government
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $government)
    {
        $check = $government->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}