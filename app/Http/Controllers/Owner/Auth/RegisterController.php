<?php

namespace App\Http\Controllers\Owner\Auth;

use App\FormatDataCollection;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\PlaceOwner;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


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

    use RegistersUsers, FormatDataCollection;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/owner';

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
        $days = $this->getDays();
        $governs = $this->getGovernorates();
        $categories = $this->getCategories();
        // dd($governs);
        return view('owners.auth.register', compact('days', 'governs', 'categories'));
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
            'email' => 'required|email|unique:place_owner',
            'account_type' => 'required|numeric|in:0,1',
            'name' => 'required|string|min:3|max:255',
            'tax_record' => 'required|string|unique:places',
            'address' => 'required|string|min:3|max:255',
            'about' => 'required|string',
            'phone' => 'required|string',
            'city_id' => 'required|numeric|exists:cities,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'opened_time' => 'required|string',
            'closed_time' => 'required|string',
            'closed_days' => ['array', Rule::in(array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))]

        ], [
            'name.required' => 'حقل الاسم مطلوب',
            'name.min' => 'يجب ان يحتوي حقل الاسم على الاقل خمس احرف',

            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.min' => 'حقل كلمة المرور يجب ان يحتوي على الاقل ٨ احرف',
            'password.confirmed' => 'الرجاء كتابة كلمة المرور مره اخرى بشكل صحيح',

            'email.required' => 'حقل البريد الالكتروني مطلوب',
            'email.email' => 'الرجاء كتابة البريد الالكتروني بشكل صحيح',
            'email.unique' => 'هذا البريد الالكنروني موجود بالفعل',


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\PlaceOwner
     */
    protected function create(array $data)
    {
        return PlaceOwner::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'account_type' => $data['account_type'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function createPlace(array $data, PlaceOwner $owner)
    {
        $owner->place()->create($data);
    }
    protected function guard()
    {
        return Auth::guard("owners");
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $messages = [];
        if ($request->closed_time <= $request->opened_time)
            return back()->with('closed_time', 'الرجاء اختيار معاد اغلاق مناسب');
        $request->merge(['closed_days' => $request->has('closed_days') ? implode(",", $request->closed_days) : '', 'password' => bcrypt($request->password)]);

        $owner = $this->create($request->all());
        $this->createPlace($request->all(), $owner);
        flash(__('messages.add'), 'success');
        // $this->guard()->login($user);

        return  back();
    }
}