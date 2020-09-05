@extends('layouts.app')
@section('page_title')
{{ __('pages.Users') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{__('pages.Edit').' '. __('pages.User') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>['user.update',$model->id],
            'method' => 'put'
            ])
            !!}
            @include('cpanel.users.form')
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
