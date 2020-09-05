@extends('layouts.app')
@section('page_title')
{{ __('pages.Roles') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{__('pages.Edit').' '. __('pages.Role') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>['role.update',$model->id],
            'method' => 'put'
            ])
            !!}
            @include('cpanel.roles.form')
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
