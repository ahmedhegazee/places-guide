@extends('owners.app')
@section('page_title')
{{ __('pages.Discounts') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.Edit').' '.__('pages.Discount') }}</h3>

        </div>
        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($discount,[
            'route'=>['discount.update',$discount->id],
            'method' => 'put',
            'files'=>true,
            ])
            !!}
            @include('owners.discounts.form')
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
