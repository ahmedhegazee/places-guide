@extends('owners.app')
{{-- @inject('client', 'App\Models\Client') --}}
{{-- @inject('request', 'App\Models\DonationRequest') --}}
{{-- @inject('post', 'App\Models\Post') --}}
@section('page_title')
{{ __('pages.Dashboard') }}
@endsection

@section('additional_styles')
@include('partials.grid-view-styles')
<style>
    #map {
        width: 80%;
        height: 80vh;
    }
</style>
@endsection
@section('additional_scripts')
@include('partials.grid-view-scripts')
@include('partials.delete')
@include('layouts.maps.scripts.with-marker')
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">

    @include('flash::message')
    <!-- Default box -->
    <div class="card">

        <div class="card-body" style="font-size:1.5rem">
            {{-- <div class="row justify-content-end mb-2 ">
                <a href="{{route('category.create')}}" class="btn btn-primary"><i class="fas fa-edit"></i>
            {{ __('pages.Edit') }}</a>
        </div> --}}
        {{-- <span class="text-bold">{{ __('pages.Owner').' : '}} </span>
        <span>{{  $place->owner->full_name }}</span><br> --}}
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
        <span>{{  $place->category->name}}</span><br>
        <span class="text-bold">{{ __('pages.SubCategory').' : '}} </span>
        <span>{{  $place->subCategory->name??'لا يوجد تصنيف فرعي'}}</span><br>
        <span class="text-bold">{{ __('pages.Opened Time').' : '}} </span>
        <span>{{  $place->opened_time}}</span><br>
        <span class="text-bold">{{ __('pages.Closed Time').' : '}} </span>
        <span>{{  $place->closed_time}}</span><br>
        <span class="text-bold">{{ __('pages.Closed Days').' : '}} </span>
        <span>{{  $place->closed_days}}</span><br>
        <input type="hidden" data="{{ $place->owner->preventAccountTypeAttribute = true }}">
        @if ($place->owner->account_type&&!is_null($place->latitude)&&!is_null($place->longitude))
        @include('layouts.maps.html.with-marker')
        @endif

    </div>
    <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
