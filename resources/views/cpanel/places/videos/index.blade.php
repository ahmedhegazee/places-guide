@extends('layouts.app')
@section('page_title')
{{ __('pages.Videos').' '.$place->name }}
@endsection
@section('additional_styles')
@include('partials.grid-view-styles')
@endsection
@section('additional_scripts')
@include('partials.grid-view-scripts')
@include('partials.delete')
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @include('flash::message')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('pages.List Of').' '. __('pages.Videos').' '.$place->name }}</h3>

        </div>
        <div class="card-body">
            <div class="row justify-content-end mb-2 ">
                <a href="{{route('video.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    {{ __('pages.Add').' '.__('pages.Video') }}</a>
            </div>
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>{{ __('pages.Video') }}</th>
                    <th>{{ __('pages.Show') }}</th>
                    <th>{{ __('pages.Edit') }}</th>
                    <th>{{ __('pages.Delete') }}</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr id="record-{{ $record->id }}">
                        <td>{{$loop->iteration}}</td>
                        <td><video playsinline="playsinline" width="200px" height="200px" src={{ $record->src }}
                                controls> </video></td>
                        <td>
                            <a href="{{route('dashboard.video.show',['video'=>$record->id,'place'=>$place->id])}}"
                                class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <a href="{{route('dashboard.video.edit',['video'=>$record->id,'place'=>$place->id])}}"
                                class="btn btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="{{route('dashboard.video.destroy',['video'=>$record->id,'place'=>$place->id])}}"
                                id="delete-route-{{ $record->id }}"
                                onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center">
                        <td colspan=6>{{ __('pages.No Data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$records->links()}}
        </div>
        <!-- /.card-body -->
        @csrf
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
