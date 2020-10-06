@extends('layouts.app')
@inject('client', 'App\Models\Client')
{{-- @inject('request', 'App\Models\DonationRequest') --}}
{{-- @inject('post', 'App\Models\Post') --}}
@section('page_title')
{{ __('pages.Dashboard') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @if (app()->getLocale()=='ar')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <div class="info-box-content">
                    <span class="info-box-text">العملاء</span>
                    <span class="info-box-number">{{$client->count()}}</span>
                </div>
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <div class="info-box-content">
                    <span class="info-box-text">الاماكن</span>
                    <span class="info-box-number">{{$countPlaces}}</span>
                </div>
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marker"></i></span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <div class="info-box-content">
                    <span class="info-box-text">طلبات الانضمام</span>
                    <span class="info-box-number">{{$countOwnerRequest}}</span>
                </div>
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-plus"></i></span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <div class="info-box-content">
                    <span class="info-box-text">العروض المتاحة</span>
                    <span class="info-box-number">{{$discountsCount}}</span>
                </div>
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-percent"></i></span>
            </div>
        </div>

    @else
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{__('pages.Clients')}}</span>
                    <span class="info-box-number">{{$client->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marker"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{__('pages.Companies')}}</span>
                    <span class="info-box-number">{{$countPlaces}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{__('pages.Owner Requests')}}</span>
                    <span class="info-box-number">{{$countOwnerRequest}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-percent"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{__('pages.Discounts')}}</span>
                    <span class="info-box-number">{{$discountsCount}}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
    <!-- Default box -->


</section>
<!-- /.content -->
@endsection
