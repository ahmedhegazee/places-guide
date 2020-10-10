@extends('front.master')
@section('content')
<nav class="mb-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('main.home')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $category->name[app()->getLocale()] }}</li>
    </ol>
</nav>
<section class="categories py-2">
    <div class="container">
        <div class="row">
{{--            @include('layouts.filter-sidebar')--}}
            <div class="col-md-3 col-sm-12">
                <div id="map" style="width:100%;height:300px;" ></div>
                <div class="row mt-3">
                    @foreach($records as $record)
                    <div class="col-md-6 col-sm-12"><img src="{{$record->main_image}}" alt="" width="100%"></div>
                    @endforeach
                </div>
            </div>
            <div class="row col-md-9 col-sm-12">
                @foreach($records as $record)
                <div class="col-md-12 col-sm-12" onclick="navigateToPlace('{{ route('place',['place'=>$record->id]) }}')">
                    <div class="card mb-4 shadow-sm">
                        {{-- <a href="{{ route('place',['place'=>$record->id]) }}" class="category"> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{$record->main_image }}" width="100%" height="100px" alt="">
                                  <input type="hidden" vlaue="{{$record->enableRatingAttribute=true}}">
                                  <div class="mt-3">
                                      @for ($i = 0; $i < $record->rating; $i++) <i class="fas fa-star mr-1">
                                      </i>
                                      @endfor
                                  </div>
                                </div>
                                <div class="col-md-9">
                                    <h3 class="card-text">{{ $record->name[app()->getLocale()] }}</h3>
                                    @if (!is_null($record->address[app()->getLocale()]))
                                        <div id="address">
                                            <span><i class="fas fa-map-marker-alt"></i>{{ ' '.$record->address[app()->getLocale()] }}</span>
                                        </div>
                                    @endif
                                    <p style="max-height:100px; overflow:hidden;">{{ $record->about[app()->getLocale()] }}</p>
                                    <a href="{{ route('place',['place'=>$record->id]) }}" class="btn btn-link" style="color:#000">{{__('main.read more')}}
                                    </a><br /><br>
                                    <a class="btn btn-success" href="tel:{{ $record->phone }}" target="_blank"><i
                                            class="fas fa-phone"></i>{{__('main.call')}} </a>
                                    {{-- <a class="btn btn-success" href="tel:{{ $record->phone }}" target="_blank"><i
                                        class="fas fa-phone"></i>
                                    </a> --}}
                                    @if (!is_null($record->website))
                                        <a class="btn btn-primary" style="background: transparent; color:#000" href="{{ $record->website }}" target="_blank"><i
                                                class="fas fa-link"></i>{{__('main.website')}}</a>
                                    @endif

                                </div>
                            </div>

                        </div>
                        {{-- </a> --}}
                    </div>
                </div>
                @if (!is_null($record->longitude)&&!is_null($record->latitude))
                        <input type="hidden" value="{{$record->longitude}}" class="lng"><input type="hidden" value="{{$record->latitude}}" class="lat">
                @endif

                @endforeach

            </div>
        </div>

        {{-- pagination --}}
        <div class="row justify-content-center">
            {{ $records->appends(['city'=>request()->city])->links() }}
        </div>
    </div>
</section>
@endsection


@section('slider')
<!--main-header-->
<div class="category-header" style="background:url({{ $category->image }})">
    <div class="row justify-content-center align-content-center">
        <h2>{{ $category->name[app()->getLocale()] }}</h2>
    </div>

</div>
<!--End main-header-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
            $('.multiple-select').select2({
                dir: 'rtl'
            });
        });
function navigateToPlace(url){
    location.assign(url);
}
        function getCities() {
            let govern = $('#govern').val();
            // console.log(govern);

            $.ajax({
                url: `${location.origin}/api/v1/cities?govern=${govern}`
            }).done(function (data) {
                let cities = data.data;

                let defaultElement = $('#city').children().first();
                $('#city').empty();
                $(defaultElement).appendTo('#city');
                // $(`<option selected="" disabled=""></option>`).appendTo('#city');
                cities.forEach(function (city) {
                    $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
                });
            })
        }

        function getSubCategories() {
            let category = $('#category').val();
            // console.log(govern);

            $.ajax({
                url: `${location.origin}/api/v1/sub-categories?category=${category}`
            }).done(function (data) {
                let cities = data.data;

                let defaultElement = $('#sub_category').children().first();
                $('#sub_category').empty();
                $(defaultElement).appendTo('#sub_category');
                // $(`<option selected="" disabled=""></option>`).appendTo('#city');
                cities.forEach(function (city) {
                    $(`<option value=${city.id}>${city.name}</option>`).appendTo('#sub_category');
                });
            })
        }
        $('.heart-icon').click(function () {
            var icon = $(this).find('i');
            let post = $(this).attr('data-post');
            let token = $('input[name="_token"]').val();
            $.ajax({
                url: '/favourite/post',
                type: 'post',
                data: {
                    post: post,
                    _token: token
                },
                success: function (response) {
                    if ($(this).hasClass('fas')) {
                        $(this).removeClass('fas').addClass('far');
                    } else {
                        $(this).removeClass('far').addClass('fas');
                    }
                }
            });
        });
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_TOKEN') }}&callback=initMap&libraries=&v=weekly"
    defer>
</script>
<script>
    let map;
    document.onload = function () {
        initMap();
    }

    function initMap() {

        let longs = document.getElementsByClassName('lng');
        let lats = document.getElementsByClassName('lat');
        // console.log(long);
        if (longs != null && lats != null) {
            lat = parseFloat(lats[0].value);
            long = parseFloat(longs[0].value);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: lat,
                    lng: long
                },
                zoom: 8
            });
            for (let i=0;i<lats.length;i++){
                var marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(lats[i].value),
                        lng: parseFloat(longs[i].value)
                    },
                    map: map
                });
            }

        }
    }
</script>

@endpush
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: transparent !important;
        color: #777 !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__choice__remove {
        color: #ccc !important;

    }

    .select2-selection__choice__remove:hover {
        background-color: transparent !important;
        color: #777 !important;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-results__option {
        text-align: justify;
    }
</style>
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

    .categories {
        min-height: 90vh;
    }

    .category-header {
        overflow: hidden;
        background-repeat: no-repeat !important;
        height: 70vh;
        background-size: cover !important;
        background-attachment: fixed !important;
    }

    .category-header .row {
        height: 100%;
        color: #fff;
    }

    .category-header h2 {
        font-size: 4rem;
        font-weight: bold;
    }

    .category h3 {
        font-size: 1.5rem;
    }

    .subcategories {
        list-style: none;
    }

    .subcategories,
    .filter {
        border: 1px solid #aaa;
        border-radius: 5px;
    }

    .subcategories li {
        border-bottom: 1px solid #aaa;
        color: #777;
        background: #fffefede;
        padding: 5px 10px;
    }

    .subcategories a:last-of-type li {
        border: none;
        border-radius: 0 0 5px 5px;
    }

    .subcategories a:first-of-type li {
        border-radius: 5px 5px 0 0;
    }

    .subcategories li:hover,
    .subcategories ul .active {
        color: #000;
        background: #f9f9f9
    }

    .fa-chevron-left {
        padding-top: 10px;
        font-size: .25rem;
    }

    .subcategories li .count,
    .filter .filter-header,
    .fa-chevron-left {
        color: #777;
    }

    .filter {
        padding: 30px 20px;
        padding-bottom: 10px;

    }

    .filter .filter-header {
        margin: 0;
        font-size: 1rem;
        margin-bottom: 10%;
        border-bottom: 1px solid #aaa;
        padding-bottom: 15px;
    }

    .select2-selection {
        border-radius: 2px !important;
        margin-bottom: 10% !important;
    }

    @media(max-width: 768px) {
        .category-header {
            height: 38vh;
        }
    }

    .filter-button {
        border-radius: 0px;
        width: 100%;
    }
</style>
@endpush
