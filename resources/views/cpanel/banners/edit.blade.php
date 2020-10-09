@extends('layouts.app')
@section('page_title')
{{ __('main.Banners') }}

@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Edit').' '.__('main.Banner') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($banner,[
            'route'=>['banner.update',$banner->id],
            'method' => 'put',
            'files'=>true
            ])
            !!}
            @include('cpanel.banners.form')
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
