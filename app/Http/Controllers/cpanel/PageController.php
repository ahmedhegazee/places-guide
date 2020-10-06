<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Page::all();

        return view('cpanel.pages.index', compact('records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Settings $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('cpanel.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Settings $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'content' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'content.*' => 'required|string|min:3|max:1500',
        ]);
        $request->merge(['content'=>json_encode($request->get('content')),]);
        $page->update($request->all());
        flash(__('messages.add'), 'success')->important();
        return redirect()->route('page.index');
    }
}
