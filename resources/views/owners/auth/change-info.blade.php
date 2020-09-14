@extends('owners.app')
@section('page_title')
{{ __('pages.Edit').' '.__('pages.Account Data') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">

        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>'owner.change-info',
            'method'=>'post'
            ])
            !!}
            @csrf
            <div class="form-group">
                <label for="full_name">{{ __('pages.Name') }}</label>
                {!!Form::text('full_name',null,[
                'class'=>'form-control ',
                ])!!}
            </div>
            <div class="form-group">
                <label for="email">{{ __('pages.Email') }}</label>
                {!!Form::email('email',null,[
                'class'=>'form-control ',

                ])!!}
            </div>
            <button id="submitBtn" class="btn btn-primary" id="submit" type="submit">{{ __('pages.Submit') }}</button>

            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
