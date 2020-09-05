@extends('layouts.app')
@section('page_title')
Settings
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Edit Setting</h3>

    </div>
    <div class="card-body">

      @include('partials.validation-errors')
      {!!
      Form::model($setting,[
      'route'=>['setting.update',$setting->id],
      'method' => 'put'
      ])
      !!}
      <div class="form-group">
        <label for="value"> {{$setting->name}}</label>
        {!!Form::text('value',null,[
        'class'=>'form-control'
        ])!!}
      </div>
      <div class="form-group ">
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>
      {!!Form::close()!!}
    </div>
    <!-- /.card-body -->

  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection