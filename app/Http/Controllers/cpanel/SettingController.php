<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Settings::all();
        return view('settings.index', compact('records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Settings $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Settings $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $setting)
    {
        $this->validate($request, [
            'value' => 'required|min:3',
        ]);
        $setting->update($request->all());
        flash('Setting is updated', 'success')->important();
        return redirect()->route('setting.index');
    }
}