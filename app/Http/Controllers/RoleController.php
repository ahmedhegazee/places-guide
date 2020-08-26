<?php

namespace App\Http\Controllers;

use App;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::paginate(10);
        return view('roles.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name' => 'required|string|unique:roles',
            'permissions_list' => 'required|array'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions_list);
        flash('Added Successfully', 'success')->important();
        return redirect(route('role.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $model = $role;
        return view('roles.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => ['required', 'string', Rule::unique('roles')->ignore($role->id)],
            'permissions_list' => 'required|array',
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions_list);
        flash('Updated Successfully', 'success')->important();
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $check = $role->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
    }
}