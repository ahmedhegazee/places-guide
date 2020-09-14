@extends('owners.app')

@section('page_title')
{{ __('pages.Company Videos') }}
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">

        <div class="card-body">
            @include('owners.videos.video')
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
