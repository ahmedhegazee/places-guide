<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\WorkerCategory;
use Illuminate\Http\Request;

class WorkerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = WorkerCategory::paginate(10);
        return view('cpanel.workercategories.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.workercategories.create');
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
            'name' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
        ]);
        $request->merge(['name'=>json_encode($request->get('name')),]);
        WorkerCategory::create($request->all());
        flash(__('messages.add'), 'success');
        return redirect()->route('worker-category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkerCategory  $worker_category
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkerCategory $worker_category)
    {
        return view('cpanel.workercategories.edit', compact('worker_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkerCategory  $worker_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkerCategory $worker_category)
    {
        $this->validate($request, [
            'name' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'name.*' => 'required|string|min:3|max:255',
        ]);
        $request->merge(['name'=>json_encode($request->get('name')),]);
        $worker_category->update($request->all());
        flash(__('messages.update'), 'success');
        return redirect()->route('worker-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkerCategory  $worker_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkerCategory $worker_category)
    {
        $check = $worker_category->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}
