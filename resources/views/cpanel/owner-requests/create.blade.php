@extends('layouts.app')
{{-- @inject('model', 'App\Models\PlaceOwner') --}}
@section('page_title')
{{ __('pages.Owner Requests') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('pages.Create').' '. __('pages.New Request') }}
            </h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model(null,[
            'route'=>'owner-request.store',
            'method'=>'post'
            ])
            !!}
            @csrf
            @include('cpanel.owner-requests.form')
            <div class="row justify-content-end">
                <button id="nextBtn" class="btn btn-primary ml-2" type="button" onclick="showNext()">التالي</button>
                <button id="prevBtn" class="btn btn-primary" type="button" style="display:none"
                    onclick="showPrev()">السابق</button>
                <button id="submitBtn" class="btn btn-primary" id="submit" style="display:none"
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
