@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">ارسال رابط تغيير كلمة المرور</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<section class="signup text-center">
    @include('partials.validation-errors')
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="container">
        <div class="py-4 mb-4">
            <form action="{{ route('password.email') }}" class="w-75 m-auto" method="POST">
                @csrf
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="form-control my-3 @error('phone') is-invalid @enderror" placeholder="رقم الهاتف">
                <button type="submit" class="btn btn-success py-2 w-50">ارسال الرابط</button>
            </form>
        </div>
    </div>
</section>
@endsection
