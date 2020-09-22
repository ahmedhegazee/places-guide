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
            @if (!is_null($video))
            <div class="row justify-content-end mb-2 ">
                <a href="{{route('video.edit',['video'=>auth('owners')->user()->place->id])}}"
                    class="btn btn-success"><i class="fas fa-edit"></i>
                    {{ __('pages.Edit').' '.__('pages.Video') }}</a>
            </div>
            @include('owners.videos.video')
            @else
            <div class="alert alert-success">لا يوجد فيديو في الوقت الحالي</div>
            <div class="row justify-content-end mb-2 ">
                <a href="{{route('video.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    {{ __('pages.Add').' '.__('pages.Video') }}</a>
            </div>
            @endif

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
