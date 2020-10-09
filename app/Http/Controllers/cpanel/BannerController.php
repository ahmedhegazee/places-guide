<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Banner::paginate(10);
        return view('cpanel.banners.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.banners.create');
    }
    public function show(Banner $banner)
    {
        return view('cpanel.banners.show', compact('banner'));
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
            'content' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'content.*' => 'required|string|min:3|max:600',
            'title' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'title.*' => 'required|string|min:3|max:255',
            'image' => 'required|image|max:8000'
        ]);
        $request->merge(['content' => json_encode($request->get('content')),'title' => json_encode($request->get('title')),]);
        $data = $request->only(['content','title']);
                $data['image'] = storeFileOnAzure($request->file('image'), 'banners');

        Banner::create($data);
        flash(__('messages.add'), 'success');
        return redirect()->route('banner.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //        dd($banner->content);
        return view('cpanel.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'content' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'content.*' => 'required|string|min:3|max:600',
            'title' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'title.*' => 'required|string|min:3|max:255',
            'image' => 'sometimes|image|max:8000'
        ]);
        $request->merge(['content' => json_encode($request->get('content')),'title' => json_encode($request->get('title')),]);
        $data = $request->only(['content','title']);
        if ($request->has('image'))
            $data['image'] = storeFileOnAzure($request->file('image'), 'banners');
        $banner->update($data);
        flash(__('messages.update'), 'success');
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $check = $banner->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}
