@extends('owners.app')
@inject('model', 'App\Models\WorkAd')
@section('page_title')
{{ __('pages.Work Ads') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Add').' '.__('pages.Ad') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model(null,[
            'route'=>'work-ad.store'
            ])
            !!}
            @include('owners.workads.form')
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
