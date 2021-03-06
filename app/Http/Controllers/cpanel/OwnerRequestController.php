<?php

namespace App\Http\Controllers\cpanel;

use App\FormatDataCollection;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Place;
use App\Models\PlaceOwner;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OwnerRequestController extends Controller
{
    use FormatDataCollection;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = PlaceOwner::accepted(0)
            // ->with(['place' => function ($q) use ($request) {
            //     $q->search($request->search);
            // }])
            ->paginate(10);
        // dd($records);
        return view('cpanel.owner-requests.index', compact('records'));
    }

    public function create()
    {
        $days = $this->getDays();
        $governs = $this->getGovernorates();
        $categories = $this->getCategories();
        // dd($governs);
        return view('cpanel.owner-requests.create', compact('days', 'governs', 'categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // dd(implode(",", $request->closed_days));
        // dd($request->all());
        $rules = [
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:place_owner',
            'password' => 'required|string|min:8|confirmed|max:255',
            'account_type' => 'required|numeric',
            'name' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
            'tax_record' => 'required|string|unique:places',
            'address' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'address.*' => 'required|string|min:3|max:255',
            'about' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'about.*' => 'required|string|min:3|max:500',
            'phone' => 'required|string',
            // 'city_id' => ['required', 'numeric', Rule::in(City::all('id')->toArray())],
            'city_id' => 'required|numeric|exists:cities,id',
            // 'sub_category_id' => ['required', 'numeric', Rule::in(SubCategory::all('id')->toArray())],
            // 'sub_category_id' => 'nullable|numeric|exists:sub_categories,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'opened_time' => 'required|string',
            'closed_time' => 'required|string',
            'closed_days' => ['array', Rule::in(array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))]
        ];
        $messages = [];
        $this->validate($request, $rules, $messages);
        if ($request->closed_time <= $request->opened_time)
            return back()->with('closed_time',  __('messages.Choose correct close time'));
        $request->merge([
            'closed_days' => $request->has('closed_days') ? implode(",", $request->closed_days) : '',
            'password' => bcrypt($request->password),
            'name'=>json_encode($request->get('name')),
            'about'=>json_encode($request->get('about')),
            'address'=>json_encode($request->get('address'))
        ]);
        $owner = PlaceOwner::create($request->all());
        $owner->place()->create($request->all());
        flash(__('messages.add'), 'success');
        return redirect(route('owner-request.index'));
    }
    public function update(Request $request, PlaceOwner $owner_request)
    {
        // $check = $owner_request->update(['is_accepted' => 1]);
        $owner_request->is_accepted = 1;
        $check = $owner_request->save();
        if ($check) {
            return jsonResponse(1, 'success', ['msg' => __('messages.Accepted Successfully')]);
        } else {
            return jsonResponse(0, 'error');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaceOwner $owner_request)
    {
        $check = $owner_request->delete();
        if ($check) {
            return jsonResponse(1, 'success', ['msg' => 'تم رفض الطلب وحذفه بنجاح']);
        } else {
            return jsonResponse(0, 'error');
        }
    }
}
