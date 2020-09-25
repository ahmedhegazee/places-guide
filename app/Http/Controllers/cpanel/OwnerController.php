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
    public function update($owner, Request $request)
    {
        $owner = PlaceOwner::find($owner);
        // dd($owner);
        // dd($request->all());
        $msg = '';
        if ($request->has('ban')) {
            $check = $owner->update(['is_banned' => $request->ban]);
            if ($request->ban) {
                $msg = 'تم الحظر';
            } else
                $msg = 'تم فك الحظر';
            if ($check) {
                return jsonResponse(1, 'success', ['msg' => $msg]);
            } else {
                return jsonResponse(0, 'error');
            }
        } else if ($request->has('account')) {
            $owner->account_type = intval($request->account);
            $check = $owner->save();
            // dd($check);
            if (intval($request->account)) {
                $msg = 'تم التحويل الى عضوية الماسية';
            } else
                $msg = 'تم التحويل الى عضوية فضية';
            if ($check) {
                return jsonResponse(1, 'success', ['msg' => $msg]);
            } else {
                return jsonResponse(0, 'error');
            }
        }
    }
}