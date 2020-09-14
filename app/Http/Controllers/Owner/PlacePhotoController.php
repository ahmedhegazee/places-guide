<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PlacePhoto;
use Illuminate\Http\Request;

class PlacePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = PlacePhoto::paginate(10);
        return view('owners.photos.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owners.photos.create');
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
            'file.*' => 'required|image|max:4000'
        ]);
        // dd($request->all());
        $files = $request->file('file');
        //insert all images in only one time || TODO Search for that
        foreach ($files as $img) {
            $request->user()->place->photos()->create([
                'src' => storeFileOnGoogleCloud($img, 'images')
            ]);
        }
        flash(__('messages.add'), 'success');
        return redirect(route('photo.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function show(PlacePhoto $photo)
    {
        return view('owners.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacePhoto $photo)
    {

        return view('owners.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlacePhoto $photo)
    {
        $this->validate($request, [
            'file' => 'required|image|max:4000'
        ]);
        deleteFile(str_replace(env('APP_URL') . '/', '', $photo->src));
        $photo->update(['src' => storeFileOnGoogleCloud($request->file('file'), 'images')]);
        flash(__('messages.update'), 'success');
        return redirect()->route('photo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacePhoto $photo)
    {
        deleteFile(str_replace(env('APP_URL') . '/', '', $photo->src));
        $check = $photo->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}
