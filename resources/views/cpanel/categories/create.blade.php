@extends('layouts.app')
@inject('model', 'App\Models\Category')
@section('page_title')
{{ __('pages.Companies Categories') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Add').' '.__('pages.Category') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>'category.store'
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
