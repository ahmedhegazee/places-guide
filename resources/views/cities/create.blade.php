@extends('layouts.app')
@inject('model', 'App\Models\City')
@section('page_title')
        Cities of {{$govern->name}}

@endsection
@section('content')
        <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create City</h3>

        </div>
        <div class="card-body">
            
        @include('partials.validation-errors')
            {!!
                Form::model($model,[
                    'route'=>['city.store','govern'=>$govern->id]
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

