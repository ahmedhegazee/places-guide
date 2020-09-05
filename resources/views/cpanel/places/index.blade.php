@extends('layouts.app')

@section('page_title')
{{ __('pages.Companies') }}
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
            <h3 class="card-title">{{ __('pages.List Of').' '. __('pages.Companies') }}</h3>

        </div>
        <div class="card-body">
            {{-- <div class="row justify-content-end mb-2 ">
                <a href="{{route('category.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
            {{ __('pages.Add').' '.__('pages.Category') }}</a>
        </div> --}}
        <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <th>#</th>
                <th>{{ __('pages.Name') }}</th>
                <th>{{ __('pages.Owner') }}</th>
                <th>{{ __('pages.Category') }}</th>
                <th>{{ __('pages.Show') }}</th>
                {{-- <th>{{ __('pages.Edit') }}</th> --}}
                {{-- <th>{{ __('pages.Delete') }}</th> --}}
            </thead>
            <tbody>
                @forelse ($records as $record)
                <tr id="record-{{ $record->id }}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$record->name}}</td>
                    <td>{{$record->owner->full_name}}</td>
                    <td>{{$record->subCategory->category->name}}</td>
                    <td>
                        <a href="{{route('place.show',['place'=>$record->id])}}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>
                    </td>
                    {{-- <td>
                            <a href="{{route('place.edit',['place'=>$record->id])}}" class="btn btn-success"><i
                        class="fas fa-edit"></i></a>
                    </td> --}}
                    {{-- <td>
                            <a href="{{route('place.destroy',['place'=>$record->id])}}"
                    id="delete-route-{{ $record->id }}"
                    onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                    class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td> --}}
                </tr>
                @empty
                <tr style="text-align: center">
                    <td colspan=5>{{ __('pages.No Data') }}</td>
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
