@extends('layouts.app')
@section('page_title')
Change Password
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Change Passwprd</h3>

        </div>
        <div class="card-body">
            @include('flash::message')
            @include('partials.validation-errors')
            {!!
            Form::model(null,[
            'route'=>'change-password',
            'method' => 'post'
            ])
            !!}
            <div class="form-group">
                <label for="old_password"> Old Password</label>
                {!!Form::password('old_password',[
                'class'=>'form-control'
                ])!!}
            </div>
            <div class="form-group">
                <label for="new_password"> New Password</label>
                {!!Form::password('new_password',[
                'class'=>'form-control'
                ])!!}
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                {!!Form::password('new_password_confirmation',[
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
