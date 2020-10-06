@extends('front.master')

@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-5" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('main.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.login')}}</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
    <section class="signup-form my-4 py-4">
        @include('partials.validation-errors')
        <div class="my-5 text-center"><img src="{{ asset('images/logo.png') }}" alt="logo"></div>
        <form action="{{ $loginRoute }}" class="w-75 mx-auto my-5" method="POST">
            @csrf
            <h2 class="text-center">{{ $title }}</h2>
            <input type="text" name="email" class="form-control  my-3 py-3" id="usName" value="{{ old('email') }}"
                placeholder="{{__('main.email')}}">
            <input type="password" name="password" class="form-control my-3 py-3" id="usPassword"
                placeholder="{{__('main.password')}}">
            <div class="form-check float-right my-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{__('main.Remember me')}}
                </label>
            </div>
            @if (!is_null($resetPasswordRoute))
            @if (Route::has('password.request'))
            <div class="float-left my-4"><a href="{{ $resetPasswordRoute }}"><i
                        class="fas fa-exclamation-triangle px-2"></i><span>{{__('main.Forget Password')}}</span></a></div>
            @endif
            @endif

            <div class="clr"></div>
            <div class="form-row my-4">
                <div class="col">
                    <button type="submit" class="form-control py-3 bg-success text-white">{{__('main.login')}}</button>
                </div>
                @if (!is_null($registerRoute))
                <div class="col">
                    <a href="{{ $registerRoute }}" type="submit" class="form-control text-center py-3 bg">{{__('main.register')}}</a>
                </div>
                @endif

            </div>
        </form>
    </section>
</div>
@endsection
