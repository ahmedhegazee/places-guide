<?php

namespace App\Http\Controllers\cpanel;

use App\FormatDataCollection;
use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class placeController extends Controller
{
    use FormatDataCollection;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $records = Place::search($request->search)
        $records = Place::available()
            ->search($request->search)
            ->searchCity($request->city)
            ->searchCategory($request->category)
            ->searchSubCategory($request->subcategory)
            ->with(['city.governorate', 'subCategory', 'category'])
            ->paginate(10);
        // dd($records);
        return view('cpanel.places.index', compact('records'));
    }
    public function create()
    {
        $governs = $this->getGovernorates();
        $days = $this->getDays();
        $categories = $this->getCategories();
        return view('cpanel.places.create', compact('governs', 'days', 'categories'));
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
            'tax_record' => 'required|string|unique:places',
            'address' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'address.*' => 'required|string|min:3|max:255',
            'about' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'about.*' => 'required|string|min:3|max:500',
            'phone' => 'required|string',
            // 'city_id' => ['required', 'numeric', Rule::in(City::all('id')->toArray())],
            'city_id' => 'required|numeric|exists:cities,id',
            // 'sub_category_id' => ['required', 'numeric', Rule::in(SubCategory::all('id')->toArray())],
            // 'sub_category_id' => 'nullable|numeric|exists:sub_categories,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'opened_time' => 'required|string',
            'closed_time' => 'required|string',
            'closed_days' => ['array', Rule::in(array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))],
            'main_image' => 'sometimes|image|max:4000',
        ];
        $messages = [];
        $this->validate($request, $rules, $messages);
        if ($request->closed_time <= $request->opened_time)
            return back()->with('closed_time', __('messages.Choose correct close time'));

        $request->merge([
            'closed_days' => $request->has('closed_days') ? implode(",", $request->closed_days) : '',
            'name' => json_encode($request->get('name')),
            'about' => json_encode($request->get('about')),
            'address' => json_encode($request->get('address'))
        ]);

        $owner = Place::create($request->all());
        flash(__('messages.add'), 'success');
        return redirect(route('place.index'));
    }
    public function show(Place $place)
    {
        $place->preventClosedDaysAttribute = false;
        if (!is_null($place->owner))
            $place->owner->preventAccountTypeAttribute = false;
        // dd($place);
        return view('cpanel.places.show', compact('place'));
    }
    public function edit(Place $place)
    {
        // dd($place->main_image);
        $governs = $this->getGovernorates();
        $days = $this->getDays();
        $categories = $this->getCategories();
        $model = $place;
        return view('cpanel.places.edit', compact('governs', 'days', 'categories', 'model'));
    }
    public function update(Request $request, Place $place)
    {
        $rules = [
            'name' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
            'tax_record' => ['required', 'string', Rule::unique('places')->ignore($place->id)],
            'address' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'address.*' => 'required|string|min:3|max:255',
            'about' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'about.*' => 'required|string|min:3|max:500',
            'phone' => 'required|string',
            // 'city_id' => ['required', 'numeric', Rule::in(City::all('id')->toArray())],
            'city_id' => 'required|numeric|exists:cities,id',
            // 'sub_category_id' => ['required', 'numeric', Rule::in(SubCategory::all('id')->toArray())],
            // 'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'opened_time' => 'required|string',
            'closed_time' => 'required|string',
            'closed_days' => ['required', 'array', Rule::in(array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))],
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'main_image' => 'sometimes|image|max:4000'
        ];
        $this->validate($request, $rules);
        if ($request->closed_time <= $request->opened_time)
            return back()->with('closed_time', __('messages.Choose correct close time'));
        // dd();
        $request->merge(['closed_days' => implode(",", $request->closed_days), 'longitude' => number_format($request->longitude, 6), 'latitude' => number_format($request->latitude, 6)]);
        if ($request->has('main_image')) {
            $path = storeFileOnAzure($request->file('main_image'), 'images');
            $data = $request->except('main_image');
            $data['main_image'] = $path;
        } else {
            $data = $request->all();
        }

        // dd($data);
        $place->update($data);
        flash(__('messages.update'), 'success');
        return redirect(route('place.index'));
    }

    public function destroy(Place $place)
    {

        $check = $place->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
    public function best(Place $place, Request $request)
    {
        // dd($owner);
        // dd($request->all());
        $msg = '';
        if ($request->has('best')) {
            $place->is_best = intval($request->best);
            $check = $place->save();
            // dd($check);
            if (intval($request->best)) {
                $msg = 'تم وضع هذا المكان في قائمة افضل الاماكن';
            } else
                $msg = 'تم ازالة هذا المكان من قائمة افضل الاماكن';
            if ($check) {
                return jsonResponse(1, 'success', ['msg' => $msg]);
            } else {
                return jsonResponse(0, 'error');
            }
        }
    }
}