@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">اتصل بنا</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
<section class="contact py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-1">
                <div class="contact-details">
                    <h5 class="py-3 text-center">اتصل بنا</h5>
                    <div class="text-center py-3"><img src="{{ asset('front/imgs/logo.png') }}" alt="img-logo"></div>
                    <div class="contact-mail p-3">
                        <p class="py-1">الجوال <span> : {{ $settings->get(1)->value }}</span></p>
                        <p class="py-1">فاكس <span> : {{ $settings->get(8)->value }}</span></p>
                        <p class="py-1">البريد الاليكترونى <span> : {{ $settings->get(0)->value }}</span></p>
                    </div>
                    <div class="contact-social text-center">
                        <h6 class="py-2"> تواصل معنا</h6>
                        <ul class="list-unstyled d-flex justify-content-center py-md-3">
                            {{-- <li class="ml-2"><a class="google" href=""><i class="fab fa-google-plus-square"></i></a></li> --}}
                            <li class="mx-2"><a class="whatsapp" target="_blank"
                                    href="https://wa.me/2{{ $settings->get(1)->value }}"><i
                                        class="fab fa-whatsapp-square"></i></a></li>
                            <li class="mx-2"><a class="insta" target="_blank" href="{{ $settings->get(4)->value }}"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="mx-2"><a class="youtube" target="_blank" href="{{ $settings->get(2)->value }}"><i
                                        class="fab fa-youtube-square"></i></a></li>
                            <li class="mx-2"><a class="twitter" target="_blank" href="{{ $settings->get(5)->value }}"><i
                                        class="fab fa-twitter-square"></i></li>
                            <li class="mr-2"><a class=" facebook" target="_blank"
                                    href="{{ $settings->get(3)->value }}"><i class="fab fa-facebook-square"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-1">

                <div class="contact-form text-center">
                    <h5 class="py-3">تواصل معنا</h5>
                    @include('flash::message')
                    <form action="{{ route('contact.store') }}" method="POST">
                        @include('partials.validation-errors')
                        @csrf
                        <input type="text" name="name" class="form-control my-3" placeholder="الاسم">
                        <input type="mail" name="email" class="form-control my-3" placeholder="البريد الاليكترونى">
                        <input type="text" name="phone" class="form-control my-3" placeholder="الجوال">
                        <input type="text" name="messgAddres" class="form-control my-3" placeholder="عنوان الرسالة">
                        <textarea name="messageText" class="form-control my-4" rows="5"
                            placeholder="نص الرسالة"></textarea>
                        <button type="submit" class="btn py-3 bg w-100 ">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
