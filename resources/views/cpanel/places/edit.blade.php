@extends('layouts.app')
@section('page_title')
{{ __('pages.Edit').' '.__('pages.Company') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('pages.Edit').' '. __('pages.Company') }}
            </h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'url'=>route('place.update',['place'=>$model->id]),
            'method'=>'put',
            'files'=>true,
            ])
            !!}
            @csrf
            @include('cpanel.places.form')
            <div class="row justify-content-end">

                <button id="prevBtn" class="btn btn-primary ml-2" type="button" style="display:none"
                    onclick="showPrev()">السابق</button>
                <button id="nextBtn" class="btn btn-primary ml-2" type="button" onclick="showNext()">التالي</button>
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
