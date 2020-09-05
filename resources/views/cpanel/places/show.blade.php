@extends('layouts.app')

@section('page_title')
{{$place->name}}
@endsection
@section('additional_styles')
@include('partials.grid-view-styles')
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
        let long= document.getElementById('long');
        let lat= document.getElementById('lat');
        if(long!=undefined && lat !=undefined)
    map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: lat, lng: long },
    zoom: 8
    });
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
            <span class="text-bold">{{ __('pages.Owner').' : '}} </span>
            <span>{{  $place->owner->full_name }}</span><br>
            <span class="text-bold">{{ __('pages.Account Type').' : '}} </span>
            <span>{{  $place->owner->account_type }}</span><br>
            <span class="text-bold">{{ __('pages.Govern').' : '}} </span>
            <span>{{  $place->city->governorate->name}}</span><br>
            <span class="text-bold">{{ __('pages.City').' : '}} </span>
            <span>{{  $place->city->name}}</span><br>
            <span class="text-bold">{{ __('pages.Phone').' : '}} </span>
            <span>{{  $place->phone}}</span><br>
            <span class="text-bold">{{ __('pages.Tax Record').' : '}} </span>
            <span>{{  $place->tax_record}}</span><br>
            <span class="text-bold">{{ __('pages.Category').' '.__('pages.Company').' : '}} </span>
            <span>{{  $place->subCategory->category->name}}</span><br>
            <span class="text-bold">{{ __('pages.SubCategory').' : '}} </span>
            <span>{{  $place->subCategory->name}}</span><br>
            <span class="text-bold">{{ __('pages.Opened Time').' : '}} </span>
            <span>{{  $place->opened_time}}</span><br>
            <span class="text-bold">{{ __('pages.Closed Time').' : '}} </span>
            <span>{{  $place->closed_time}}</span><br>
            <span class="text-bold">{{ __('pages.Closed Days').' : '}} </span>
            <span>{{  $place->closed_days}}</span><br>
            <input type="hidden" data="{{ $place->owner->preventAccountTypeAttribute = true }}">
            @if ($place->owner->account_type)
            <input type="hidden" id="lat" value="{{ $place->latitude }}">
            <input type="hidden" id="long" value="{{ $place->longitude }}">
            <div class="row">
                <div id="map"></div>
            </div>
            @endif

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
