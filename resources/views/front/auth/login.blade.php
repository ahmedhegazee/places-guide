@extends('front.master')

@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-5" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
    <section class="signup-form my-4 py-4">
        @include('partials.validation-errors')
        <div class="my-5 text-center"><img src="{{ asset('front/imgs/logo.png') }}" alt="logo"></div>
        <form action="{{ url('/login') }}" class="w-75 mx-auto my-5" method="POST">
            @csrf
            <input type="text" name="email" class="form-control  my-3 py-3" id="usName" value="{{ old('email') }}"
                placeholder="البريد الالكتروني">
            <input type="password" name="password" class="form-control my-3 py-3" id="usPassword"
                placeholder="كلمة المرور">
            <div class="form-check float-right my-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    تذكرنى
                </label>
            </div>
            @if (Route::has('password.request'))
            <div class="float-left my-4"><a href="{{ route('password.request') }}"><i
                        class="fas fa-exclamation-triangle px-2"></i><span>هل نسيت كلمة
                        المرور</span></a></div>
            @endif
            <div class="clr"></div>
            <div class="form-row my-4">
                <div class="col">
                    <button type="submit" class="form-control py-3 bg-success text-white">دخول</button>
                </div>
                <div class="col">
                    <a href="{{ route('front.register') }}" type="submit" class="form-control text-center py-3 bg">انشاء
                        حساب
                        جديد</a>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
