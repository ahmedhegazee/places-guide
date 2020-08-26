<?php

namespace App\Http\Controllers;

use App\ImageUtility;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'category' => ['sometimes', 'numeric', Rule::in(Category::all()->pluck('id')->toArray())],
            'city' => ['sometimes', 'numeric', Rule::in(City::all()->pluck('id')->toArray())],
            'blood' => ['sometimes', 'numeric', Rule::in(BloodType::all()->pluck('id')->toArray())],
            // 'search' => 'sometimes|string'
        ]);
        $records = Client::search($request->search)
            ->searchBloodType($request->blood)
            ->searchCity($request->city)
            ->paginate(10);
        return view('clients.index', compact('records'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        flash('Updated Successfully', 'success')->important();
        return back();
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
}