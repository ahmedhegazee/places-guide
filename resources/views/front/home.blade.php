@extends('front.master')
@section('content')
<!--About section-->
<section class="about py-5">
    <div class="container">
        <div class="about-cont py-3">
            <p class="pl-4"><span> بنك الدم</span> هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق يطلع على صورة حقيقة لتطبيق
                الموقع
            </p>
        </div>
    </div>
    <!--End container-->
</section>
<!--End About-->
<!--Articles section-->
<section class="articles py-5">
    <div class="title">
        <div class="container">
            <h2><span class="py-1">المقالات</span> </h2>
        </div>
        <hr />
    </div>
    <div class="article-slide mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="arrow text-left">
                        <button type="button" class="prev-arrow px-2 py-1"><i class="fas fa-chevron-right"></i></button>
                        <button type="button" class="next-arrow px-2 py-1"><i class="fas fa-chevron-left"></i></button>
                    </div>
                </div>
            </div>
            <div class="slick2">
                @foreach ($posts as $post)
                <div class="slick-cont">
                    <div class="card">
                        <img src="{{ asset($post->photo) }}" class="card-img-top" alt="slick-img">
                        <div class="heart-icon"><i class="far fa-heart"></i></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p style="overflow: hidden;height:110px;" class="mb-4">{{ $post->content }}
                            </p>
                            <div class="text-center"><a href="{{ route('post.show',$post->id) }}"
                                    class="btn bg px-5">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--End container-->
</section>
<!--End Articles-->
<!--Donation-->
<section class="donation">
    <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
    <hr />
    <div class="donation-request py-5">
        <div class="container">
            <div class="selection w-75 d-flex mx-auto my-4">
                <select class="custom-select">
                    <option selected>اختر فصيلة الدم</option>
                    <option value="+AB">+AB</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                </select>
                <select class="custom-select mx-md-3 mx-sm-1">
                    <option selected>اختر المدينة</option>
                    <option value="القاهرة">القاهرة</option>
                    <option value="الجيزة">الجيزة</option>
                    <option value="القليوبيه">القليوبيه</option>
                    <option value="سوهاج">سوهاج</option>
                </select>
                <div><i class="fas fa-search"></i></div>
            </div>
            <!--End selection-->
            <div id="donations"></div>
            <!--End last req-item-->
        </div>
        <!--End container-->
    </div>
    <!--End Donation-request-->
</section>
<!--End Donation-->
<!--Contact-us-->
<section class="contact-us py-5 mt-4">
    <div class="container">
        <div class="row">
            <div class="contact-info col-md-6 col-sm-12 text-center">
                <h4 class="text-center"><span class="brd">اتصل بنا </span> </h4>
                <p class="my-5">يمكنك الأتصال بنا للاستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="phone-nm mx-auto">
                    <a href="https://wa.me/2{{ $settings->get(1)->value }}">
                        <p class="text-right"><span class="">+2</span>{{ $settings->get(1)->value }}</p>
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
                <h4 class="mt-5 mb-4">تطبيق بنك الدم</h4>
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
</section>
<!--End blood-app-->
@endsection


@section('slider')
<!--main-header-->
<div class="main-header">
    <div class="slide">
        <img src="{{ asset('front/imgs/header.jpg') }}" class="d-block w-100" alt="...">
        <div class="slick-caption">
            <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
            <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                النص
                العرب</p>
            <button class="btn bg px-5">المزيد</button>
        </div>
    </div>
    <div class="slide">
        <img src="{{ asset('front/imgs/header.jpg') }}" class="d-block w-100" alt="...">
        <div class="slick-caption">
            <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
            <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                النص
                العرب</p>
            <button class="btn bg px-5">المزيد</button>
        </div>
    </div>
    <div class="slide">
        <img src="{{ asset('front/imgs/header.jpg') }}" class="d-block w-100" alt="...">
        <div class="slick-caption">
            <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
            <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                النص
                العرب</p>
            <button class="btn bg px-5">المزيد</button>
        </div>
    </div>
</div>
<!--End main-header-->
@endsection