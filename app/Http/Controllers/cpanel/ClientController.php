<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Client::search($request->search)
            ->paginate(10);
        // dd($records);
        return view('cpanel.clients.index', compact('records'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {

        $check = $client->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
    public function update(Client $client, Request $request)
    {

        $check = $client->update(['is_banned' => $request->ban]);
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