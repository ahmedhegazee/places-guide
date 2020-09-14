@extends('owners.app')
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
            <h3 class="card-title">{{ __('pages.Edit').' '.__('pages.Ad') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($work_ad,[
            'route'=>['work-ad.update',$work_ad->id],
            'method' => 'put'
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
