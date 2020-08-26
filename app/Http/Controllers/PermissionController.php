<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Permission::paginate(10);
        return view('permissions.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|string|unique:permissions',
        ]);
        $permission = Permission::create($request->all());
        flash('Permission is added', 'success')->important();
        return redirect(route('permission.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $model = $permission;
        return view('permissions.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => ['required', 'string', Rule::unique('permissions')->ignore($permission->id)],
        ]);
        $permission->update($request->all());
        flash('Permission is updated', 'success')->important();
        return redirect(route('permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        flash('Permission is deleted', 'success')->important();
        return redirect(route('permission.index'));
    }
}