<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!auth()->user()->can('show-users'))
        //     abort(403);
        $records = User::paginate(10);
        return view('users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->getRoles();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
            'roles_list' => 'required|array'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->roles()->sync($request->roles_list);
        flash('Added Successfully', 'success')->important();
        return redirect(route('user.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->getRoles();
        $model = $user;
        return view('users.edit', compact('model', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
            'roles_list' => 'required|array'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user->update($request->all());
        $user->roles()->sync($request->roles_list);
        flash('Updated Successfully', 'success')->important();
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $check = $user->delete();
        if ($check) {
            return jsonResponse(1, 'success');
        } else {
            return jsonResponse(0, 'error');
        }
        // flash('User is updated', 'success')->important();
        // return redirect(route('user.index'));
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => bcrypt($request->new_password)
            ]);
            flash('password is changed successfully', 'success')->important();
            return back();
        } else {
            return back()->withErrors(['old_password' => 'The old password is not correct']);
        }
    }
    public function showPasswordForm()
    {
        return view('auth.change-password');
    }
    function getRoles()
    {
        return
            Role::all()->mapWithKeys(function ($role) {
                return [
                    $role->id =>  $role->display_name,
                ];
            })->toArray();
    }
}