@extends('front.master')
@section('content')
<nav class="mb-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('main.home')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $place->name[app()->getLocale()] }}</li>
    </ol>
</nav>
{!! $place->enableRatingAttribute=true !!}
<section class="categories py-2 ">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 col-sm-12">
                {{-- use carsoul of main page --}}
                <div id="myCarousel" class="carousel slide" data-ride="false" data-interval="false">
                    <div id="content" class="row justify-content-between">
                        <span style="color:#fff;font-size:1.5rem">{{ $place->name[app()->getLocale()] }}</span>
                        <span
                            class="badge badge-danger">{{ __('pages.Rating').' '.$place->rating .' '.__('pages.From 5')}}</span>
                    </div>
                    <div class="carousel-inner">
                        @if (!is_null($place->video))
                        <div class="carousel-item active">
                            <video src="{{ $place->video }}" controls width="100%" height="100%"></video>
                        </div>
                        @endif
                        <div class="carousel-item {{ !is_null($place->video)?'':'active' }}">
                            <img width="100%" height="100%" src="{{ $place->main_image }}">
                        </div>
                        @foreach ($place->photos as $photo)
                        <div class="carousel-item ">
                            <img width="100%" height="100%" src="{{ $photo->src }}">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                {{-- add header and icon and put the about in paragraph --}}
                <div class="card w-100 mt-4 mb-2" id="about">
                    <div class="card-header">
                        <h3>{{__('pages.Company About')}}</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $place->about[app()->getLocale()] }}
                        </p>
                    </div>
                </div>

                <div id="time" class="card w-100  mb-2 ">
                    <div class="card-header">
                        <h3>{{__('pages.Work Time')}}</h3>
                    </div>
                    <div class="card-body">
                        <span
                            class="d-inline-block">{{  __('pages.Opened Time').' : '.date('h:i a',strTotime($place->opened_time)) }}</span><br>
                        <span
                            class="d-inline-block">{{ __('pages.Closed Time').' : '.date('h:i a',strToTime($place->closed_time)) }}</span>
                    </div>
                </div>
                <div id="time" class="card w-100  mb-2 ">
                    <div class="card-header">
                        <h3>{{__('pages.Closed Days')}}</h3>
                    </div>
                    <div class="card-body">
                        {!! $place->preventClosedDaysAttribute=false !!}
                        <span>{{ is_null($place->closed_days)?__('main.Open All Week'):$place->closed_days }}</span>
                    </div>

                </div>
                <div id="comments" class="card w-100  mb-6">
                    <div class="card-header">
                        <h3>{{__('main.visitors rating')}}</h3>
                    </div>
                    <div class="card-body">
                        @forelse ($place->reviews as $review)
                        <div class="mb-4 review">
                            <div class="row justify-content-between mx-auto">
                                <div class="d-inline mb-3">
                                    <h5 class="d-inline ml-2">{{ $review->client->full_name }}</h5>
                                    <span class="text-muted d-inline-block"
                                        style="direction: ltr;font-size: .75rem;">{{ $review->created_at->format('d M Y ,h:i a ') }}</span>
                                </div>
                                <div class="ml-2">
                                    @for ($i = 0; $i < $review->rating; $i++) <i class="fas fa-star mr-1">
                                        </i>
                                        @endfor
                                </div>
                            </div>
                            <pre class="review-content rer-2">{{ $review->content }}</pre>
                        </div>
                        @empty

                        @endforelse
                        @auth('clients')
                        @if (auth('clients')->user()->isReviewed($place->id))
                        <div class="mb-4 review">
                            <form action="{{ route('review',['place'=>$place->id]) }}" method="POST">
                                @include('flash::message')
                                @csrf
                                <div class="row justify-content-end ml-2">
                                    @for ($i = 0; $i < 5; $i++) <i class="far fa-star mr-1" onclick="rate({{ $i+1 }})">
                                        </i>
                                        @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating" value="0">
                                <div class="form-group">
                                    <label for="content">{{__('main.comment')}}</label>
                                    <textarea name="content" class="form-control" cols="30" rows="10"
                                        placeholder="{{__('main.write your experience')}}" required></textarea>
                                </div>
                                <div class="form-group ">
                                    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
                                </div>
                            </form>
                        </div>
                        @endif
                        @endauth
                        @guest
                        <div class="mb-4 review">
                            <form action="{{ route('review',['place'=>$place->id]) }}" method="POST">
                                @include('flash::message')
                                @csrf
                                <div class="row justify-content-end ml-2">
                                    @for ($i = 0; $i < 5; $i++) <i class="far fa-star mr-1" onclick="rate({{ $i+1 }})">
                                        </i>
                                        @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating" value="0">
                                <div class="form-group">
                                    <label for="content">{{__('main.comment')}}</label>
                                    <textarea name="content" class="form-control" cols="30" rows="10"
                                        placeholder="{{__('main.write your experience')}}" required></textarea>
                                </div>
                                <div class="form-group ">
                                    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
                                </div>
                            </form>
                        </div>
                        @endguest
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-12">
{{--                @if ($place->owner->is_accepted)--}}
                <div id="social-media" class="card w-100  mb-2 p-3" style="color:#000">
                    <ul class="list-unstyled">
                        <li class="d-inline-block mx-2">
                            @if (!is_null($place->facebook))
                            <a class="facebook" href="{{ $place->facebook }}" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                        @endif
                        @if (!is_null($place->instagram))
                        <li class="d-inline-block mx-2"><a class="insta" href="{{ $place->instagram }}"
                                target="_blank"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if ($place->twitter)
                        <li class="d-inline-block mx-2"><a class="twitter" href="{{ $place->twitter }}"
                                target="_blank"><i class="fab fa-twitter"></i></a></li>
                        @endif

                        @if ($place->youtube)
                        <li class="d-inline-block mx-2"><a class="twitter" href="{{ $place->youtube }}"
                                target="_blank"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if ($place->website)
                        <li class="d-inline-block mx-2"><a class="twitter" href="{{ $place->website }}"
                                target="_blank"><i class="fas fa-link"></i></a></li>
                        @endif
                        @if ($place->phone)
                        <li class="d-inline-block mx-2"><a class="twitter" href="tel:{{ $place->phone }}"
                                target="_blank"><i class="fas fa-phone"></i></a></li>
                        @endif

                        {{-- <li class="d-inline-block mx-2"><a class="whatsapp"
                                                    href="https://wa.me/2{{ $settings->get(1)->value }}"
                        target="_blank"><i class="fab fa-whatsapp"></i></a></li> --}}
                    </ul>
                </div>
{{--                @endif--}}
                @if (!is_null($place->latitude)&&!is_null($place->longitude))
                <div class="card w-100  mb-2 p-3">

                    @include('layouts.maps.html.with-marker')

                </div>
                @endif
                @if (!is_null($place->address))
                <div id="address" class="card w-100  mb-2 p-3">
                    <span><i class="fas fa-map-marker-alt"></i>{{ ' '.$place->address[app()->getLocale()] }}</span>
                </div>
                @endif

            </div>
        </div>

        {{-- pagination --}}

    </div>
</section>
@endsection

{{--
@section('slider')
<!--main-header-->
<div class="category-header" style="background:url({{ $category->image }})">
<div class="row justify-content-center align-content-center">
    <h2>{{ $category->name }}</h2>
</div>

</div>
<!--End main-header-->
@endsection --}}

@push('styles')
<style>
    .breadcrumb {
        background: #2d3e50;
        border: none
    }

    .breadcrumb a {
        color: #fff;
    }

    .breadcrumb .active {
        color: #D0934D;
    }

    .carousel .carousel-item {
        height: 60vh;
    }

    .category-header .row {
        height: 100%;
        color: #fff;
    }


    .categories {
        min-height: 90vh;
    }

    #content {
        position: absolute;
        z-index: 100;
        width: 90%;
        top: 6%;
        left: 7%;
    }

    #social-media a {
        color: #000;
    }

    #social-media a:hover {
        color: #aaa !important;
    }

    .badge-danger {
        padding-top: 2% !important;
    }

    .review {
        border-bottom: 1px solid #ccc;
        padding-bottom: 1.5rem;
    }

    .review-content {
        all: unset;
        font-size: .75rem !important;
        color: rgb(0 0 0 / 55%);
        padding-right: 10px;
    }

    .fa-star {
        color: #ffc107;
    }

    #map {
        width: 100%;
        height: 45vh;
    }
</style>
@endpush
@push('scripts')
<script>
    let stars=document.getElementsByClassName('fa-star');
    function rate($rating){
            let rating = document.getElementById('rating');
            rating.value=parseInt($rating);
            removeRating();
            for (let index = 0; index < $rating; index++) {
                stars[index].classList.remove('far');
                stars[index].classList.add('fas');
            }
        }
        function removeRating(){
            for (let index = 0; index < 5; index++) {
                if(stars[index].classList.contains('fas')){
                    stars[index].classList.remove('fas');
                stars[index].classList.add('far');
                }
            }
        }
</script>
@include('layouts.maps/scripts/with-marker')
@endpush
