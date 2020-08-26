@extends('layouts.app')
@section('page_title')
    Governments
@endsection
@section('content')
        <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Government</h3>

        </div>
        <div class="card-body">
            
        @include('partials.validation-errors')
            {!!
                Form::model($government,[ 
                    'route'=>['government.update',$government->id],
                    'method' => 'put'
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

