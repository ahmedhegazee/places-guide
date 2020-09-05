<?php

namespace App\Http\Controllers\cpanel;

use App;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        return view('cpanel.roles.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request->all())->validate();

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions_list);
        flash(__('messages.add'), 'success');
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
        return view('cpanel.roles.edit', compact('model'));
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
        $this->validateData($request->all(), $role)->validate();
        $role->update($request->all());
        $role->permissions()->sync($request->permissions_list);
        flash(__('messages.update'), 'success');
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
    public function validateData($data, $role = null)
    {
        // dd($role);
        if (!is_null($role))
            $rules = [
                'name' => ['required', 'string', Rule::unique('roles')->ignore($role->id)],
                'permissions_list' => 'required|array',
            ];
        else
            $rules = [
                'name' => 'required|string|unique:roles',
                'permissions_list' => 'required|array'
            ];
        $messages = [
            'name.required' => 'حقل الاسم مطلوب',
            'name.string' => 'حقل الاسم يجب ان يكون نصا',
            'name.unique' => 'اسم التربة يجب ان يكون مميزا',
            'permissions_list.required' => 'اختيار الصلاحيات مطلوب',
            'permissions_list.array' => 'الصلاحيات يحب ان تكون مجموعة',
        ];
        return Validator::make($data, $rules, $messages);
    }
}