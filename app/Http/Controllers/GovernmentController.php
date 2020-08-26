<?php

namespace App\Http\Controllers;

use App\Models\Government;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Government::paginate(10);
        return view('governments.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('governments.create');
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
        Government::create($request->all());
        flash('Added Successfully', 'success')->important();
        return redirect()->route('government.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function show(Government $government)
    {
        $records = $government->cities()->paginate(10);
        return view('governments.show', compact('records', 'government'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function edit(Government $government)
    {
        return view('governments.edit', compact('government'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Government $government)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        $government->update($request->all());
        flash('Updated Successfully', 'success')->important();
        return redirect()->route('government.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function destroy(Government $government)
    {
        $check = $government->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}