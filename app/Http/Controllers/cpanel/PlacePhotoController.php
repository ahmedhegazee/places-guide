<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\PlacePhoto;
use Illuminate\Http\Request;

class PlacePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Place $place)
    {
        $records = $place->photos;
        return view('cpanel.places.photos.index', compact('records', 'place'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Place $place)
    {
        return view('cpanel.places.photos.create', compact('place'));
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
            'file.*' => 'required|image|max:4000'
        ]);
        // dd($request->all());
        $files = $request->file('file');
        if ((sizeOf($files) + $place->photos->count()) <= 10) {
            //insert all images in only one time || TODO Search for that
            foreach ($files as $img) {
                $place->photos()->create([
                    'src' => storeFileOnAzure($img, 'images')
                ]);
            }
            flash(__('messages.add'), 'success');
            return redirect(route('dashboard.photo.index', compact('place')));
        } else {
            flash('اقصى عدد للصور هو ١٠ صور', 'danger');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place, PlacePhoto $photo)
    {
        return view('cpanel.places.photos.show', compact('photo', 'place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place, PlacePhoto $photo)
    {

        return view('cpanel.places.photos.edit', compact('photo', 'place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place, PlacePhoto $photo)
    {
        $this->validate($request, [
            'file' => 'required|image|max:4000'
        ]);
        deleteFile(str_replace(env('APP_URL') . '/', '', $photo->src));
        $photo->update(['src' => storeFileOnAzure($request->file('file'), 'images')]);
        flash(__('messages.update'), 'success');
        return redirect()->route('dashboard.photo.index', compact('place'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PlacePhoto $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place, PlacePhoto $photo)
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