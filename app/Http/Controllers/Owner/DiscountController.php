<?php

namespace App\Http\Controllers\Owner;

use App\FormatDataCollection;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    use FormatDataCollection;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $request->user()->place->discounts()->paginate(10);
        // dd($records);
        return view('owners.discounts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('owners.discounts.create');
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
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:3',
            'discount' => 'required|string|min:3|max:255',
            'starting_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:starting_date',
            'image' => 'required|image|max:4000',
        ]);
        $data = $request->except('image');
        $data['image'] = storeFileOnGoogleCloud($request->image, 'images');
        $request->user()->place->discounts()->create($data);
        flash(__('messages.add'), 'success');
        return redirect(route('discount.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        return view('owners.discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $categories = $this->getCategories();
        return view('owners.discounts.edit', compact('discount', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $this->validate($request, [
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:3',
            'discount' => 'required|string|min:3',
            'starting_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:starting_date',
            'image' => 'sometimes|image|max:4000'
        ]);
        $data = $request->except('image');
        if ($request->has('image'))
            $data['image'] = storeFileOnGoogleCloud($request->image, 'images');
        $discount->update($data);
        flash(__('messages.update'), 'success');
        return redirect()->route('discount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {

        $check = $discount->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}