@extends('layouts.app')
@inject('model', 'App\Models\PlacePhoto')
@section('page_title')
{{ __('pages.Company Photos') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Add').' '.__('pages.Photo') }}</h3>

        </div>
        <div class="card-body">
            @include('flash::message')
            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>['dashboard.photo.store',$place->id],
            'files'=>true
            ])
            !!}
            @include('owners.layouts.upload')
            <button id="submitBtn" class="btn btn-primary" id="submit" type="submit">{{ __('pages.Submit') }}</button>
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
