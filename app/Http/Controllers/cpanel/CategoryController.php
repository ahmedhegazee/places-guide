<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::paginate(10);
        return view('cpanel.categories.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.categories.create');
    }
    public function show(Category $category)
    {
        $records = $category->subCategories()->with('places')->paginate(10);
        return view('cpanel.categories.show', compact('records', 'category'));
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
            'name' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
            'image' => 'required|image|max:4000'
        ]);
        $request->merge(['name' => json_encode($request->get('name')),]);
        $data = $request->only('name');
                $data['image'] = storeFileOnAzure($request->file('image'), 'categories');
        $data['image'] = '';
        Category::create($data);
        flash(__('messages.add'), 'success');
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //        dd($category->name);
        return view('cpanel.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => ['required', 'array', 'min:' . sizeof($this->langs), 'max:' . sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
            'image' => 'sometimes|image|max:4000'
        ]);
        $request->merge(['name' => json_encode($request->get('name')),]);
        $data = $request->only('name');
        if ($request->has('image'))
            $data['image'] = storeFileOnAzure($request->file('image'), 'categories');
        $category->update($data);
        flash(__('messages.update'), 'success');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $check = $category->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}
