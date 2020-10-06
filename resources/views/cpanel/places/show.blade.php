@extends('layouts.app')

@section('page_title')
{{ $place->name[app()->getLocale()] }}
@endsection
@section('additional_styles')
@include('partials.grid-view-styles')
<style>
    #map {
        height: 70vh;
    }
</style>
@endsection
@section('additional_scripts')
@include('partials.grid-view-scripts')
@include('partials.delete')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_TOKEN') }}&callback=initMap&libraries=&v=weekly"
    defer>
</script>
<script>
    let map;

    function initMap() {
        let long = document.getElementById('long');
        let lat = document.getElementById('lat');
        if (long != undefined && lat != undefined) {
            long = parseFloat(long.value);
            lat = parseFloat(lat.value);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat:lat,
                    lng: long
                },
                zoom: 12
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: long
                },
                map: map
            });
        }

    }
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @include('flash::message')
    <!-- Default box -->
    <div class="card">

        <div class="card-body" style="font-size:1.5rem">
            <span class="text-bold">{{ __('pages.Owner').' : ' }} </span>
            <span>{{ $place->owner->full_name??__('main.No Owner') }}</span><br>
            <span class="text-bold">{{ __('pages.Account Type').' : ' }}
            </span>
            <span>{{ $place->owner->account_type??__('main.No Account') }}</span><br>
            <span class="text-bold">{{ __('pages.Govern').' : ' }} </span>
            <span>{{ $place->city->governorate->name[app()->getLocale()] }}</span><br>
            <span class="text-bold">{{ __('pages.City').' : ' }} </span>
            <span>{{ $place->city->name[app()->getLocale()] }}</span><br>
            <span class="text-bold">{{ __('pages.Phone').' : ' }} </span>
            <span>{{ $place->phone }}</span><br>
            <span class="text-bold">{{ __('pages.Tax Record').' : ' }}
            </span>
            <span>{{ $place->tax_record }}</span><br>
            <span class="text-bold">{{ __('pages.Category').' '.__('pages.Company').' : ' }}
            </span>
            <span>{{ $place->category->name[app()->getLocale()] }}</span><br>
            <span class="text-bold">{{ __('pages.SubCategory').' : ' }}
            </span>
            <span>{{ $place->subCategory->name[app()->getLocale()]??__('main.No Subcategory') }}</span><br>
            <span class="text-bold">{{ __('pages.Opened Time').' : ' }}
            </span>
            <span>{{ $place->opened_time }}</span><br>
            <span class="text-bold">{{ __('pages.Closed Time').' : ' }}
            </span>
            <span>{{ $place->closed_time }}</span><br>
            <span class="text-bold">{{ __('pages.Closed Days').' : ' }}
            </span>
            <span>{{ $place->closed_days }}</span><br>
            @if (!is_null($place->owner))
            <input type="hidden" data="{{ $place->owner->preventAccountTypeAttribute = true }}">
            @if($place->owner->account_type)
            <input type="hidden" id="lat" value="{{ $place->latitude }}">
            <input type="hidden" id="long" value="{{ $place->longitude }}">
            <br>
            <div id="map"></div>
            @endif


            @endif

            @if(!is_null($place->latitude) && !is_null($place->longitude)&&is_null($place->owner))
            <input type="hidden" id="lat" value="{{ $place->latitude }}">
            <input type="hidden" id="long" value="{{ $place->longitude }}">
            <br>
            <div id="map"></div>
            @endif

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
