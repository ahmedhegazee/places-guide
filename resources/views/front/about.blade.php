@extends('front.master')
@section('content')

<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('main.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.about us')}}</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
    <section class="about-us my-4 py-5">
        <div class="my-5 text-center"><img src="{{ asset('images/logo.png') }}"
                style="border-radius: 50%;width: 50px;height: 50px;" alt="logo"></div>
        <div class="about-US-content px-4 mb-5">
            <p class="my-md-4">
                {{ $pages->first()->content[app()->getLocale()] }}
            </p>
        </div>
    </section>
    <!--End about-us-->
</div>
<!--End container-->
@endsection
