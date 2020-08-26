@extends('layouts.app')

@section('page_title')
Cities of {{$government->name}}
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
            <h3 class="card-title">List Of Cities of {{$government->name}}</h3>

        </div>
        <div class="card-body">
            <div class="row justify-content-end mb-2">
                <a href="{{route('city.create',['govern'=>$government->id])}}" class="btn btn-primary"><i
                        class="fas fa-plus"></i> Add City</a>
            </div>
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr id="record-{{ $record->id }}">
                        <td>{{$record->id}}</td>
                        <td>{{$record->name}}</td>
                        <td>
                            <a href="{{route('city.edit',['govern'=>$government->id,'city'=>$record->id])}}"
                                class="btn btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="{{route('city.destroy',['govern'=>$government->id,'city'=>$record->id])}}"
                                id="delete-route-{{ $record->id }}"
                                onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            <form id="{{'delete'.$record->id}}"
                                action="{{ route('city.destroy',['govern'=>$government->id,'city'=>$record->id]) }}"
                                method="POST" style="display: none;">
                                @method('delete')
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center">
                        <td colspan=2>No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$records->links()}}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
