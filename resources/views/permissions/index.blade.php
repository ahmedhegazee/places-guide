@extends('layouts.app')

@section('page_title')
Permissions
@endsection
@section('additional_styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('adminlte/plugins/css/responsive.bootstrap4.min.css')}}" />
@endsection
@section('additional_scripts')
<script src="{{asset('adminlte/plugins/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    $(function () {
        $("#table").DataTable({
          responsive: true,
          autoWidth: false,
          paging:false,
          searching:false,
          info:false,
        });});
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @include('flash::message')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Of Permissions</h3>

        </div>
        <div class="card-body">
            <div class="row justify-content-end mb-2">
                <a href="{{route('permission.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                    Permission</a>
            </div>
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Dispaly Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->display_name}}</td>
                        <td>{{$record->description}}</td>
                        <td>
                            <a href="{{route('permission.edit',['permission'=>$record->id])}}"
                                class="btn btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="{{route('permission.destroy',['permission'=>$record->id])}}" onclick="event.preventDefault();
                                    document.getElementById('{{'delete'.$record->id}}').submit();"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            <form id="{{'delete'.$record->id}}"
                                action="{{ route('permission.destroy',['permission'=>$record->id]) }}" method="POST"
                                style="display: none;">
                                @method('delete')
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center">
                        <td colspan=3>No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$records->links()}}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
