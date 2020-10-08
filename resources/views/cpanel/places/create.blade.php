@extends('layouts.app')
@inject('model', 'App\Models\Place')
@section('page_title')
{{ __('pages.Create').' '.__('pages.Company') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('pages.Create').' '. __('pages.Company') }}
            </h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model(null,[
            'route'=>'place.store',
            'method'=>'post',
            'files'=>true
            ])
            !!}
            @csrf
            @include('cpanel.places.form')
            <div class="row justify-content-end">

                <button id="prevBtn" class="btn btn-primary ml-2" type="button" style="display:none"
                    onclick="showPrev()">{{__('main.Prev')}}</button>
                <button id="nextBtn" class="btn btn-primary ml-2" type="button" onclick="showNext()">{{__("main.Next")}}</button>
                <button id="submitBtn" class="btn btn-success" id="submit" style="display:none"
                    type="submit">{{ __('pages.Submit') }}</button>

            </div>
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
