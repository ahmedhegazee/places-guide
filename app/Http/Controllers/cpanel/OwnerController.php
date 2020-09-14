<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\PlaceOwner;
use Hash;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = PlaceOwner::search($request->search)->accepted(1)->with('place')
            ->paginate(10);
        // dd($records);
        return view('cpanel.owners.index', compact('records'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaceOwner $owner)
    {

        $check = $owner->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
    public function update(PlaceOwner $owner, Request $request)
    {

        $check = $owner->update(['is_banned' => $request->ban]);
        $msg = '';
        if ($request->ban) {
            $msg = 'تم الحظر';
        } else
            $msg = 'تم فك الحظر';
        if ($check) {
            return jsonResponse(1, 'success', ['msg' => $msg]);
        } else {
            return jsonResponse(0, 'error');
        }
    }
}