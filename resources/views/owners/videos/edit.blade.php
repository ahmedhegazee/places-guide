@extends('layouts.app')
@section('page_title')
{{ __('pages.Company Videos') }}@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Edit').' '.__('pages.Video') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            <video playsinline="playsinline" src={{ $video->video }} controls> </video>
            {!!
            Form::model($video,[
            'route'=>['video.update',$video->id],
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
