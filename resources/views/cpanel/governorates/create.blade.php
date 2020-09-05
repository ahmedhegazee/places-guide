@extends('layouts.app')
@inject('model', 'App\Models\Governorate')
@section('page_title')
{{ __('pages.Governments') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> {{ __('pages.Create').' '. __('pages.Govern') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>'government.store'
            ])
            !!}
            @include('layouts.form')
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
