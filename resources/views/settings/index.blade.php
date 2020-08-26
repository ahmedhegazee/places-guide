@extends('layouts.app')

@section('page_title')
Settings
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
      <h3 class="card-title">List Of Settings</h3>

    </div>
    <div class="card-body">
      <table id="table" class="table table-bordered table-hover table-striped">
        <thead>
          <th>Name</th>
          <th>value</th>
          <th>Edit</th>
        </thead>
        <tbody>
          @forelse ($records as $record)
          <tr>
            <td>{{$record->name}}</td>
            <td>{{$record->value}}</td>
            <td>
              <a href="{{route('setting.edit',['setting'=>$record->id])}}" class="btn btn-success"><i
                  class="fas fa-edit"></i></a>
            </td>
          </tr>
          @empty
          <tr style="text-align: center">
            <td colspan=3>No Data</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->

  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection