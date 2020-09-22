<?php

namespace App\Http\Controllers\Front\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:clients');
        $this->middleware('guest:owners');
        $this->middleware('guest:workers');
    }
    public function showRegistrationForm()
    {
        return view('front.auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:5',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|unique:clients',
            'phone' => ['required', 'unique:clients'],
            'city_id' => ['required', Rule::in(City::all()->pluck('id')->toArray())],
        ], [
            'name.required' => 'حقل الاسم مطلوب',
            'name.min' => 'يجب ان يحتوي حقل الاسم على الاقل خمس احرف',

            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.min' => 'حقل كلمة المرور يجب ان يحتوي على الاقل ٨ احرف',
            'password.confirmed' => 'الرجاء كتابة كلمة المرور مره اخرى بشكل صحيح',

            'email.required' => 'حقل البريد الالكتروني مطلوب',
            'email.email' => 'الرجاء كتابة البريد الالكتروني بشكل صحيح',
            'email.unique' => 'هذا البريد الالكنروني موجود بالفعل',

            'phone.required' => 'حقل الجوال مطلوب',
            'phone.unique' => 'رقم الجوال موجود بالفعل',

            'city_id.required' => 'حقل المدينة مطلوب',
            'city_id.in' => 'الرجاء اختيار المدينة بشكل صحيح',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Client::create([
            'full_name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'city_id' => $data['city_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
    protected function guard()
    {
        return Auth::guard("clients");
    }
}