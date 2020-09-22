@extends('front.master')
@section('content')
<nav class="mb-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">الرئيسيه</a></li>
        <li class="breadcrumb-item active" aria-current="page">اقرب الاماكن اليك</li>
    </ol>
</nav>
<section>
    <div class="container py-2">
        {{-- <div class="alert alert-danger" id="alert"></div> --}}
        <div class="row">
            <div id="map"></div>
        </div>
    </div>
</section>
<section class="categories py-2">
    <h2 class="text-center mb-4"> اقرب الاماكن اليك</h2>
    <div class="container">
        <div class="row" id="nearest">
            {{-- @foreach ($bestPlaces as $place)
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4 shadow-sm">
                    <a href="{{ route('place',['place'=>$place->id]) }}"
            class="category">
            <div class="position-relative category-content">
                <img src="{{ $place->main_image }}" width="100%" alt="">
                {{-- <span>{{ $place->name }}</span> --}}
                {{-- </div>
                        <div class="card-body">
                            <h3 class="card-text">{{ $place->name }}</h3>
            </div>
            </a>
        </div>
    </div>
    @endforeach--}}
    </div>
    </div>
</section>
@endsection

@push('scripts')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_TOKEN') }}&callback=initMap&libraries=&v=weekly"
    defer>
</script>
<script>
    let map, infoWindow;
        // document.onload = function () {
        //     initMap();

        // }

        function initMap() {


            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 52.377956,
                    lng: 4.897070
                },
                zoom: 16
            });
            infoWindow = new google.maps.InfoWindow;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        $.ajax({
                            url: `${location.origin}/api/v1/nearest-places?lat=${pos.lat}&long=${pos.lng}`
                        }).done(function (data) {
                            let places = data.data;
                            if (places.length == 0)
                                $(
                                    '<div class="alert alert-danger w-100" id="alert">عذرا لا يوجد اماكن قريبة منك</div>')
                                .appendTo('#nearest');
                                else{
                                    for (let i = 0; i < places.length; i++) { $(`<div class="col-md-4 col-sm-12">
                                        <div class="card mb-4 shadow-sm"><a href="${location.origin+'/place/'+places[i]['id']}" class="category">
                                                <div class="position-relative category-content"><img src="${places[i]['main_image']}" width="100%" alt="">
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="card-text">${places[i]['name']}</h3>
                                                </div>
                                            </a></div>
                                        </div>`)
                                        .appendTo('#nearest');
                                        let info = new google.maps.InfoWindow;
                                        let position = {
                                        lat: parseFloat(places[i]['latitude']),
                                        lng: parseFloat(places[i]['longitude'])
                                        }
                                        info.setPosition(position);
                                        info.setContent(places[i]['name']);
                                        info.open(map);
                                        }
                                }

                        });
                        // map.setCenter(pos);
                        // var marker = new google.maps.Marker({
                        // position: pos,
                        // map: map
                        // });
                        infoWindow.setPosition(pos);
                        infoWindow.setContent('انت تقف هنا');
                        infoWindow.open(map);
                    },
                    function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
            // var marker = new google.maps.Marker({
            //     position: {
            //         lat: lat,
            //         lng: long
            //     },
            //     map: map
            // });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                '<div class="text-center">' + 'لقد فشل الموقع في تحديد مكانك' + '</div>' :
                '<div class="text-center">' + 'متصفحك لا يدعم هذه الخدمة' + '</div>'
            );
            infoWindow.open(map);
        }
</script>
@endpush
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

    #map {
        width: 100%;
        height: 80vh;
    }

    .categories {
        min-height: 70vh;
    }
</style>
@endpush
