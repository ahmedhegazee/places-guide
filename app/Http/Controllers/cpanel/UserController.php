<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

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
        return view('cpanel.users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->getRoles();
        return view('cpanel.users.create', compact('roles'));
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
        $this->validateData($request->all())->validate();
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->roles()->sync($request->roles_list);
        flash(__('messages.add'), 'success');
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
        return view('cpanel.users.edit', compact('model', 'roles'));
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
        $this->validateData($request->all(), $user)->validate();
        $request->merge(['password' => bcrypt($request->password)]);
        $user->update($request->all());
        $user->roles()->sync($request->roles_list);
        flash(__('messages.update'), 'success');
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
        if (User::all()->count() > 1) {
            if ($user->id == auth()->user()->id) {
                return jsonResponse(0, 'error', ['msg' => 'لا يمكنك حذف حسابك']);
            } else {
                $check = $user->delete();
                if ($check) {
                    return jsonResponse(1, 'success');
                } else {
                    return jsonResponse(0, 'error');
                }
            }
        } else {
            return jsonResponse(0, 'error', ['msg' => 'يجب ان يكون هناك مستخدم واحد على الاقل']);
        }

        // flash('User is updated', 'success');
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
            flash(__('messages.add'), 'success');
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
    public function validateData($data, $record = null)
    {
        // dd($record);
        if (!is_null($record))
            $rules = [
                'name' => 'required|string',
                'password' => 'required|string|confirmed',
                'email' => ['required', 'email', Rule::unique('users')->ignore($record->id)],
                'roles_list' => 'required|array'
            ];
        else
            $rules = [
                'name' => 'required|string',
                'password' => 'required|string|confirmed',
                'email' => 'required|email',
                'roles_list' => 'required|array'
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