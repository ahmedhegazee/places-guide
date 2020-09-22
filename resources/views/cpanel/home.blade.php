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
                    <span class="info-box-text">الشركات</span>
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
        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <div class="info-box-content">
                    <span class="info-box-text">Donation Requests</span>
                    <span class="info-box-number">{{$request->count()}}</span>
    </div>
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>
    </div>
    </div> --}}
    {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <div class="info-box-content">
                    <span class="info-box-text">Posts</span>
                    <span class="info-box-number">{{$post->count()}}</span>
    </div>
    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-images"></i></span>
    </div>
    </div> --}}
    @else
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Clients</span>
                    <span class="info-box-number">{{$client->count()}}</span>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Donation Requests</span>
                        <span class="info-box-number">{{$request->count()}}</span>
    </div>
    </div>
    </div> --}}
    {{-- <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-images"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Posts</span>
                        <span class="info-box-number">{{$post->count()}}</span>
    </div>
    </div>
    </div> --}}
    @endif
    </div>
    <!-- Default box -->


</section>
<!-- /.content -->
@endsection
