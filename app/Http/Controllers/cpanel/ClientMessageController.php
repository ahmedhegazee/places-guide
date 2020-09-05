<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\ClientMessage;
use Illuminate\Http\Request;

class ClientMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = ClientMessage::with('client')->search($request->search)->paginate(10);
        return view('client-messages.index', compact('records'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientMessage $message)
    {
        $check = $message->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}