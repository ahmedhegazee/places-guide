@extends('layouts.app')
@inject('model', 'App\Models\SubCategory')
@section('page_title')
{{__('pages.Categories').' '.$category->name[app()->getLocale()]}}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Create').' '. __('pages.SubCategory') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model(null,[
            'route'=>['subcategory.store','category'=>$category->id]
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
