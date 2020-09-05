<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {

        return view('cpanel.subcategories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        $category->subCategories()->create($request->all());
        flash(__('messages.add'), 'success');
        return redirect()->route('category.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, SubCategory $subcategory)
    {
        return view('cpanel.subcategories.edit', compact('category', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, SubCategory $subcategory)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);
        $subcategory->update($request->all());
        flash(__('messages.update'), 'success');
        return redirect()->route('category.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, SubCategory $subcategory)
    {
        $check = $subcategory->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}