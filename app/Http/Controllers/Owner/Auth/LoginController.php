<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/company-panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:owners')->except('logout');
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:clients')->except('logout');
        $this->middleware('guest:workers')->except('logout');
    }
    protected function guard()
    {
        return Auth::guard('owners');
    }
    // protected function credentials(Request $request)
    // {
    //     $request->merge(['is_banned' => 0]);
    //     // dd($request);
    //     return $request->only('phone', 'password', 'is_banned');
    // }
    // public function showLoginForm()
    // {

    //     return view('owners.auth.login');
    // }
    public function showLoginForm()
    {
        $loginRoute = route('owner.login');
        $registerRoute = route('owner.register');
        $title = __('main.Place Owner Dashboard');
        $resetPasswordRoute = route('owner.password.request');
        return view('front.auth.login', compact('loginRoute', 'registerRoute', 'resetPasswordRoute', 'title'));
    }
    // public function username()
    // {
    //     return 'phone';
    // }
    // protected function validateLogin(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             $this->username() => 'required|string',
    //             'password' => 'required|string',
    //         ],
    //         [
    //             'phone.required' => 'حقل الجوال مطلوب',
    //             'password.required' => 'حقل كلمة المرور مطلوب',
    //         ]
    //     );
    // }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
