@extends('layouts.app')
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
            <h3 class="card-title">{{ __('pages.Edit').' '.__('pages.Photo') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            @include('owners.photos.photo')
            {!!
            Form::model($photo,[
            'route'=>['dashboard.photo.update',$place->id,$photo->id],
            'method' => 'put',
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
