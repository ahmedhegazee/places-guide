@extends('layouts.app')
@section('page_title')
{{__('pages.Pages Content')}}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{__('pages.Edit').''.__('pages.Pages Content')}}</h3>

    </div>
    <div class="card-body">

      @include('partials.validation-errors')
      {!!
      Form::model($page,[
      'route'=>['page.update',$page->id],
      'method' => 'put'
      ])
      !!}
     @foreach($langs as $lang)
            <div class="form-group col-md-5 d-inline-block">
                <label for="value"> {{$page->name.'('.$lang.')'}}</label>
                {!!Form::textarea('content['.$lang.']',null,[
                'class'=>'form-control'
                ])!!}
            </div>
        @endforeach
        <div class="clearfix"></div>
      <div class="form-group ">
        <button class="btn btn-primary" type="submit">{{__('pages.Submit')}}</button>
      </div>
      {!!Form::close()!!}
    </div>
    <!-- /.card-body -->

  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection
