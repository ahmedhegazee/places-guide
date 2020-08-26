<?php

namespace App\Http\Controllers\Front\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\BloodType;
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
        $this->middleware('guest:client');
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
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', 'unique:clients'],
            'dob' => 'required|date|before: -16 years',
            'last_donation_date' => 'required|date|before_or_equal: -1 days',
            'city_id' => ['required', Rule::in(City::all()->pluck('id')->toArray())],
            'blood_type_id' => ['required', Rule::in(BloodType::all()->pluck('id')->toArray())],
        ], [
            'name' => [
                'required' => '',
                'min' => '',
            ],
            'password' => [
                'required' => '',
                'min' => '',
                'confirmed' => ''
            ],
            'email' => [
                'required' => '',
                'email' => '',
                'unique' => ''
            ],
            'phone' => [
                'required' => '',
                'regex' => '',
                'unique' => ''
            ],
            'dob' => [
                'required' => '',
                'date' => '',
                'before' => ''
            ],
            'last_donation_date' => [
                'required' => '',
                'date' => '',
                'before_or_equal' => ''
            ],
            'city_id' => [
                'required' => '',
                'in' => ''
            ],
            'blood_type_id' => [
                'required' => '',
                'in' => ''
            ]
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
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'dob' => $data['dob'],
            'last_donation_date' => $data['last_donation_date'],
            'city_id' => $data['city_id'],
            'blood_type_id' => $data['blood_type_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
    protected function guard()
    {
        return Auth::guard("client");
    }
}