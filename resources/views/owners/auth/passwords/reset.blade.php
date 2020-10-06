@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{__('main.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.change password')}}</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<section class="signup text-center">
    @include('partials.validation-errors')
    <div class="container">
        <div class="py-4 mb-4">
            <form action="{{ route('owner.password.update') }}" class="w-75 m-auto" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="text" name="email" value="{{ $email??old('email') }}"
                       class="form-control my-3 @error('email') is-invalid @enderror" placeholder="{{__('main.email')}}">
                <input type="password" name="password"
                       class="form-control my-3  @error('password') is-invalid @enderror" autocomplete="new-password"
                       placeholder="{{__('main.password')}}">
                <input type="password" name="password_confirmation"
                       class="form-control my-3 @error('password_confirmation') is-invalid @enderror"
                       autocomplete="new-password" placeholder="{{__('main.confirm password')}}">
                <button type="submit" class="btn btn-success py-2 w-50">{{__('main.change password')}}</button>
            </form>
        </div>
    </div>
</section>
@endsection
