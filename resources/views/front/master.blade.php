<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap file css-->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <!--Plugins file css-->
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-nao-calendar.css') }}">
    <!--google-font-->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    <!--main file css-->
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    @stack('styles')
    <style>
        .dropdown-menu{
            min-width:0 !important;
            padding:0;
        }
    </style>
    <title>{{ env('APP_NAME') }}</title>
</head>
@if (app()->getLocale()!='ar')
    <body id="left-body">
    @else
        <body>
@endif

    <!--Loading Page-->
    <div class="loading-page">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!--header section-->
    <section class="header">
        <!--top-bar-->
        <div class="top-bar py-2">
            <div class="container">
                <!--row of top-bar-->
                <div class="d-flex justify-content-between">
                    <div>
                        {{-- <a href="index.html" class="ar px-1">عربى</a>
                        <a href="" class="en px-1">EN</a> --}}
                    </div>
                    <div>
                        <ul class="list-unstyled">
                            <li class="d-inline-block mx-2"><a class="facebook" href="{{ $settings->get(3)->value }}"
                                    target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="insta" href="{{ $settings->get(4)->value }}"
                                    target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="twitter" href="{{ $settings->get(5)->value }}"
                                    target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="whatsapp"
                                    href="https://wa.me/2{{ $settings->get(1)->value }}" target="_blank"><i
                                        class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <div>


                    @guest('clients')

                        <a href="{{ url('/register') }}">{{ __('main.register') }}</a>
                        <a class="px-3 log" href="{{ url('/login') }}">{{ __('main.login') }}</a>

                    @endguest

                        <div class="connect d-inline">
                            <div class="dropdown d-inline">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    {{--                                <span> مرحبا بك </span>--}}
                                    <img src="{{asset($languages[app()->getLocale()])}}" width="25px" height="25px" alt="">
                                </a>
                                <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                                    @foreach($languages as $lang=>$img)
                                        @if($lang !=app()->getLocale())
                                    <a class="dropdown-item" href="{{ route('lang',['lang'=>$lang]) }}">
                                        <img src="{{asset($img)}}" width="25px" height="25px" alt=""> </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @auth('clients')
                    <div class="connect">
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
{{--                                <span> مرحبا بك </span>--}}
                                &nbsp; &nbsp;{{ auth('clients')->user()->full_name }}
                            </a>
                            <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('index') }}"> <i
                                        class="fas fa-home ml-2"></i>{{ __('main.home') }}</a>
                                <a class="dropdown-item" href="{{ route('front.profile') }}"> <i
                                        class="fas fa-user-alt ml-2"></i>{{ __('main.profile') }}</a>
                                <a class="dropdown-item" href="{{ route('front.password') }}"> <i
                                        class="fas fa-lock ml-2"></i>{{ __('main.change password') }}</a>
                                <a class="dropdown-item" href="{{ route('contact') }}"> <i
                                        class="fas fa-phone ml-2"></i>{{ __('main.contactus') }}</a>
                                <a class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" href="{{ url('/logout') }}"> <i
                                        class="fas fa-sign-out-alt ml-2"></i>{{ __('main.logout') }}</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                    </div>
                </div>
                <!--End row-->
            </div>
            <!--End container-->
        </div>
        <!--End top-bar-->
        <!--navbar-->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}"
                        style="border-radius: 50%;width: 50px;height: 50px;" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Route::is('index')||Route::is('category')?'active':'' }}">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('main.home') }} <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">تصنيفات الدليل</a>
                        </li> --}}

{{--                        <li class="nav-item {{ Route::is('nearest-places')?'active':'' }}">--}}
{{--                            <a class="nav-link" href="{{ route('nearest-places') }}">{{ __('main.nearest places') }}</a>--}}
{{--                        </li>--}}
                        <li class="nav-item {{ Route::is('discount')?'active':'' }}">
                            <a class="nav-link" href="{{ route('discount') }}">{{ __('main.discounts') }}</a>
                        </li>
                        <li class="nav-item {{ Route::is('workads')?'active':'' }}">
                            <a class="nav-link" href="{{ route('workads') }}">{{ __('main.job ads') }}</a>
                        </li>
                        <li class="nav-item {{ Route::is('owner.register')?'active':'' }}">
                            <a class="nav-link" href="{{ route('owner.register') }}">{{ __('main.join us') }}</a>
                        </li>
                        <li class="nav-item {{ Route::is('about')?'active':'' }}">
                            <a class="nav-link" href="{{ route('about') }}">{{ __('main.about us') }}</a>
                        </li>
                        <li class="nav-item cont {{ Route::is('contact')?'active':'' }}">
                            <a class="nav-link" href="{{ route('contact') }}">{{ __('main.contact us') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--End container-->
        </nav>
        <!--End Nav-->
        @yield('slider')
    </section>
    <!--End Header-->
    @yield('content')
    <!--Footer-->
    <footer>
        <div class="main-footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4  offset-1">
                        <img src="{{ asset('images/logo.png') }}" style="border-radius: 50%;width: 50px;height: 50px;"
                            alt="">
                        <h5 class="my-3">{{ $pages->get(1)->content[app()->getLocale()] }}</h5>
                        <p class="pl-4"> {{$pages->get(3)->content[app()->getLocale()]}}
                        </p>
                    </div>
                    <div class="col-md-3">


                        <h6 class="">{{ __('main.home') }}</h6>
                        <ul class="list-unstyled">
{{--                            <li class="py-2"><a href="{{ route('nearest-places') }}">{{ __('main.nearest places') }}</a>--}}
{{--                            </li>--}}
                            <li class="py-2"><a href="{{ route('discount') }}">{{ __('main.discounts') }}</a></li>
                            <li class="py-2"><a href="{{ route('workads') }}">{{ __('main.job ads') }}</a></li>
                            <li class="py-2"><a href="{{ route('owner.register') }}">{{ __('main.join us') }}</a></li>
                            <li class="py-2"><a href="{{ route('about') }}">{{ __('main.about us') }}</a></li>
                            <li class="py-2"><a href="{{ route('contact') }}">{{ __('main.contact us') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 available">
                        <h6 class="mb-5">{{ __('main.available on') }}</h6>


                        <div class="my-3"><a href="{{ $settings->get(6)->value }}"><img
                                    src="{{ asset('front/imgs/google1.png') }}" alt=""></a></div>
                        <div class="my-3"><a href="{{ $settings->get(7)->value }}"><img
                                    src="{{ asset('front/imgs/ios1.png') }}" alt=""></a></div>
                    </div>
                </div>
            </div>
            <!--End container-->
        </div>
        <!--End main-footer-->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="d-inline-block mx-2"><a class="facebook" target="_blank"
                                    href="{{ $settings->get(3)->value }}"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="insta" target="_blank"
                                    href="{{ $settings->get(4)->value }}"><i class="fab fa-instagram"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="twitter" target="_blank"
                                    href="{{ $settings->get(5)->value }}"><i class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="whatsapp" target="_blank"
                                    href="https://wa.me/2{{ $settings->get(1)->value }}"><i
                                        class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center">{{ __('main.copyrights') }} <span> {{ env('APP_NAME') }}</span> &copy;
                            2020</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Footer-->
    <!--scrollUp-->
    <div class="scrollUp">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--jquery/bootstrap/main file js-->
    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/js/slick.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-nao-calendar.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
