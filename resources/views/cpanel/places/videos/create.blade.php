@extends('layouts.app')
{{-- @inject('model', 'App\Models\PlaceVideo') --}}
@section('page_title')
{{ __('pages.Videos').' '.$place->name }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Add').' '.__('pages.Video') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model(null,[
            'route'=>['dashboard.video.store','place'=>$place->id],
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
