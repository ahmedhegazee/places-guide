@inject('category', 'App\Models\Category')
@extends('front.master')
@section('content')
<section class="categories py-2">
    <h2 class="text-center mb-4">الأقسام الرئيسية</h2>
    <div class="container">
        <div class="row">
            @foreach ($categories as $record)
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4 shadow-sm">
                    <a href="{{ route('category',['category'=>$record->id]) }}" class="category">
                        <div class="position-relative category-content">
                            <img src="{{$record->image }}" width="100%" height="180px" alt="">
                            <span>{{ $record->name }}</span>
                            <span class="count">{{ $record->accepted_places_count }}</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-text">{{ $record->name }}</h3>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4 shadow-sm">
                    <a href="{{ route('discount') }}" class="category">
                        <div class="position-relative category-content">
                            <img src="{{ asset('images/discounts.png') }}" width="100%" height="180px" alt="">
                            @if ($discounts>0)
                            <span class="discounts-count badge badge-danger ">{{ $discounts}}عروض</span>
                            @endif
                            <span>العروض</span>
                            {{-- <span class="count">{{ $record->accepted_places_count }}</span> --}}
                        </div>
                        <div class="card-body">
                            <h3 class="card-text">العروض</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="new-places bg-white py-2 ">
    <h2 class="text-center mb-4 mt-3">احدث الاماكن المضافة</h2>
    <div class="container">
        <div class="row">
            @foreach ($places as $record)
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4 shadow-sm">
                    <a href="{{ route('place',['place'=>$record->id]) }}" class="category">
                        <div class="position-relative category-content">
                            <img src="{{ $record->main_image }}" width="100%" height="200px" alt="">
                            <span>{{ $record->name }}</span>

                        </div>
                        <div class="card-body">
                            <h3 class="card-text">{{ $record->name }}</h3>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@auth('clients')
<section class="categories py-2">
    <h2 class="text-center mb-4"> افضل الاماكن في مدينتك</h2>
    <div class="container">
        <div class="row">
            @foreach ($bestPlaces as $place)
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4 shadow-sm">
                    <a href="{{ route('place',['place'=>$place->id]) }}" class="category">
                        <div class="position-relative category-content">
                            <img src="{{$place->main_image }}" width="100%" alt="">
                            {{-- <span>{{ $place->name }}</span> --}}
                        </div>
                        <div class="card-body">
                            <h3 class="card-text">{{ $place->name }}</h3>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endauth
{{-- <section class="best-places py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h4>أكتر الاماكن شعبية</h4>
                @foreach ($ratedPlaces as $place)
                <div class="card mb-4 shadow-sm">
                    <a href="{{ route('category',['category'=>$record->id]) }}" class="category">
<div class="position-relative category-content">
    <img src="{{$record->image }}" width="50px" height="50px" alt="">
    <span>{{ $record->name }}</span>
</div>
</a>
</div>
@endforeach

</div>
<div class="col-md-6 col-sm-12">
    <h4>اخترنا لكم</h4>
    @foreach ($bestPlaces as $place)
    <div class="card mb-4 shadow-sm">
        <a href="{{ route('category',['category'=>$record->id]) }}" class="category">
            <div class="position-relative category-content">
                <img src="{{$record->image }}" width="50px" height="50px" alt="">
                <span>{{ $record->name }}</span>
            </div>
        </a>
    </div>
    @endforeach
</div>
</div>
</div>
</section> --}}
{{-- Best Places based on City and Admin Choices  --}}
{{-- Best places based on ratings --}}
<section class="contact-us py-5 ">
    <div class="container">
        <div class="row">
            <div class="contact-info col-md-6 col-sm-12 text-center">
                <h4 class="text-center"><span class="brd">اتصل بنا </span> </h4>
                <p class="my-5">يمكنك الأتصال بنا للاستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="phone-nm mx-auto">
                    <a href="https://wa.me/2{{ $settings->get(1)->value }}">
                        <p class="text-right">
                            {{-- <span class="">+2</span> --}}
                            {{ $settings->get(1)->value }}</p>
                        <img src="{{ asset('front/imgs/whats.png') }}" alt="whats-phone">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--End container-->
</section>
<!--End Contact-us-->
<!--blood-app-->
<section class="blood-app py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="mt-5 mb-4">تطبيق {{ env('APP_NAME') }}</h4>
                <p class="appText">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                    النص
                    العرب</p>
                <div class="text-center avilb">
                    <h5 class="my-4">متوفر على</h5>
                    <a href="{{ $settings->get(6)->value }}"><img src="{{ asset('front/imgs/google.png') }}" alt=""></a>
                    <a href="{{ $settings->get(7)->value }}"><img src="{{ asset('front/imgs/ios.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-md-6 my-3"><img src="{{ asset('front/imgs/App.png') }}" class="img-fluid" alt=""></div>
        </div>
        <!--End row-->
    </div>
    <!--End container-->
    {{-- @csrf --}}
</section>
<!--End blood-app-->
@endsection


@section('slider')
<!--main-header-->
<div class="main-header">
    <div class="slide">
        <img src="{{ asset('images/background.jpg') }}" class="d-fixed w-100" alt="...">
        <div class="slick-caption">
            <h4 class="my-md-3">دليلك لافضل الاماكن</h4>
            <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                النص
                العرب</p>
            {{-- <button class="btn bg px-5">المزيد</button> --}}
        </div>
    </div>
    <div class="slide">
        <img src="{{ asset('images/background.jpg') }}" class="d-fixed w-100" alt="...">
        <div class="slick-caption">
            <h4 class="my-md-3">دليلك لافضل الاماكن</h4>
            <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                النص
                العرب</p>
            {{-- <button class="btn bg px-5">المزيد</button> --}}
        </div>
    </div>
    <div class="slide">
        <img src="{{ asset('images/background.jpg') }}" class="d-fixed w-100" alt="...">
        <div class="slick-caption">
            <h4 class="my-md-3">دليلك لافضل الاماكن</h4>
            <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                النص
                العرب</p>
            {{-- <button class="btn bg px-5">المزيد</button> --}}
        </div>
    </div>
</div>
<!--End main-header-->
@endsection

@push('scripts')
<script>
    $('.heart-icon').click(function () {
            var icon = $(this).find('i');
            let post = $(this).attr('data-post');
            let token = $('input[name="_token"]').val();
            $.ajax({
            url:'/favourite/post',
            type:'post',
            data:{
                post:post,
                _token:token
            },
            success:function(response){
                if ($(this).hasClass('fas')) {
                $(this).removeClass('fas').addClass('far');
                } else {
                $(this).removeClass('far').addClass('fas');
                }
            }
            });
        });
</script>

@endpush
@push('styles')
<style>
    .discounts-count {
        font-size: 1rem !important;
        position: absolute !important;
        top: 5%;
        left: -3%;
        bottom: unset !important;
        right: unset !important;
        padding: 8px 10px;
    }
</style>

@endpush
