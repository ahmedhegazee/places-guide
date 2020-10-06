<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:clients')->except('logout');
        $this->middleware('guest:owners')->except('logout');
        $this->middleware('guest:workers')->except('logout');
    }
    protected function guard()
    {
        return Auth::guard('clients');
    }
    protected function credentials(Request $request)
    {
        // $request->merge(['is_banned' => 0]);
        // dd($request);
        return $request->only('email', 'password', 'is_banned');
    }
    public function showLoginForm()
    {
        $loginRoute = url('/login');
        $registerRoute = route('front.register');
        $title = __('main.Website Visitors');
        $errors= new ViewErrorBag;
        $resetPasswordRoute = route('password.request');
        return view('front.auth.login', compact('loginRoute', 'registerRoute', 'title', 'resetPasswordRoute','errors'));
    }
    public function username()
    {
        return 'email';
    }
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'حقل البريد الالكتروني مطلوب',
                'password.required' => 'حقل كلمة المرور مطلوب',
            ]
        );
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
