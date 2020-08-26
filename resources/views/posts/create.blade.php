@extends('layouts.app')
@inject('model', 'App\Models\Post')
@section('page_title')
    Posts
@endsection
@section('content')
        <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create Post</h3>

        </div>
        <div class="card-body">
            
        @include('partials.validation-errors')
            {!!
                Form::model($model,[
                    'route'=>'post.store',
                    'files'=>true
                ])
                !!}
             @include('posts.form')
                {!!Form::close()!!}
           </div>
        <!-- /.card-body -->
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

