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
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => bcrypt($request->new_password)
            ]);
            flash(__('messages.add'), 'success');
            return back();
        } else {
            return back()->withErrors(['old_password' => 'The old password is not correct']);
        }
    }
    public function showPasswordForm()
    {
        return view('owners.auth.change-password');
    }
}