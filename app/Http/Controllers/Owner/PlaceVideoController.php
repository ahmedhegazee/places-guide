<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PlaceVideo;
use Illuminate\Http\Request;

class PlaceVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = PlaceVideo::paginate(10);
        return view('owners.videos.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owners.videos.create');
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
            'file' => 'required|file|mimes:mp4,webm,mpeg|max:4000'
        ]);
        // dd($request->all());
        $video = $request->file('file');
        //insert all images in only one time || TODO Search for that

        $request->user()->place->videos()->create([
            'src' => storeFileOnGoogleCloud($video, 'videos')
        ]);

        flash(__('messages.add'), 'success');
        return redirect(route('video.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  PlaceVideo $video
     * @return \Illuminate\Http\Response
     */
    public function show(PlaceVideo $video)
    {
        return view('owners.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PlaceVideo $video
     * @return \Illuminate\Http\Response
     */
    public function edit(PlaceVideo $video)
    {

        return view('owners.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PlaceVideo $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlaceVideo $video)
    {
        $this->validate($request, [
            'file' => 'required|image|max:4000'
        ]);
        deleteFile(str_replace(env('APP_URL') . '/', '', $video->src));
        $video->update(['src' => storeFileOnGoogleCloud($request->file('file'), 'videos')]);
        flash(__('messages.update'), 'success');
        return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PlaceVideo $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaceVideo $video)
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
