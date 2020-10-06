<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\WorkAd;
use App\Models\WorkerCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $request->user()->place->ads()->with('workerCategory')->paginate(10);
        // dd($records);
        return view('owners.workads.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('owners.workads.create', compact('categories'));
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
            'title' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'title.*' => 'required|string|min:3|max:255',
            'content' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'content.*' => 'required|string|min:3|max:500',
            'quantity' => 'required|numeric|min:1',
            'phone' => 'required|string',
            'work_category_id' => ['required', Rule::in(WorkerCategory::all()->pluck('id')->toArray())]
        ]);
        $request->merge(
            [
            'title'=>json_encode($request->get('title')),
            'content'=>json_encode($request->get('content')),
                ]);
        $request->user()->place->ads()->create($request->all());
        flash(__('messages.add'), 'success');
        return redirect(route('work-ad.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  WorkAd $work_ad
     * @return \Illuminate\Http\Response
     */
    public function show(WorkAd $work_ad)
    {
        return view('owners.workads.show', compact('work_ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  WorkAd $work_ad
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkAd $work_ad)
    {
        $categories = $this->getCategories();
        return view('owners.workads.edit', compact('work_ad', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  WorkAd $work_ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkAd $work_ad)
    {
        $this->validate($request, [
            'title' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'title.*' => 'required|string|min:3|max:255',
            'content' => ['required','array','min:'.sizeof($this->langs),'max:'.sizeof($this->langs)],
            'content.*' => 'required|string|min:3|max:500',
            'quantity' => 'required|numeric|min:1',
            'phone' => 'required|string',
            'work_category_id' => ['required', Rule::in(WorkerCategory::all()->pluck('id')->toArray())]
        ]);
        $request->merge(
            [
                'title'=>json_encode($request->get('title')),
                'content'=>json_encode($request->get('content')),
            ]);
        $work_ad->update($request->all());
        flash(__('messages.update'), 'success');
        return redirect()->route('work-ad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  WorkAd $work_ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkAd $work_ad)
    {

        $check = $work_ad->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
    function getCategories()
    {
        return WorkerCategory::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name[app()->getLocale()],
            ];
        })->toArray();
    }
}
