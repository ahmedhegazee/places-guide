<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Place $place)
    {
        $video = $place->video;
        return view('cpanel.places.videos.show', compact('video', 'place'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Place $place)
    {
        return view('cpanel.places.videos.create', compact('place'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Place $place)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:mp4,webm,mpeg|max:20000'
        ]);
        // dd($request->all());
        $video = $request->file('file');
        //insert all images in only one time || TODO Search for that

        $request->user()->place->update([
            'video' => storeFileOnGoogleCloud($video, 'videos')
        ]);

        flash(__('messages.add'), 'success');
        return redirect(route('dashboard.video.index', compact('place')));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Place $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place, Place $video)
    {

        return view('cpanel.places.videos.edit', compact('video', 'place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Place $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place, Place $video)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:mp4,webm,mpeg|max:20000'
        ]);
        // deleteFile(str_replace(env('APP_URL') . '/', '', $video->src));
        $video->update(['video' => storeFileOnGoogleCloud($request->file('file'), 'videos')]);
        flash(__('messages.update'), 'success');
        return redirect()->route('dashboard.video.index', compact('place'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Place $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place, Place $video)
    {
        deleteFile(str_replace(env('APP_URL') . '/', '', $video->src));
        $check = $video->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}