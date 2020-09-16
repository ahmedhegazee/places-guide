@extends('layouts.app')

@section('page_title')
{{ __('pages.Owner Requests') }}
@endsection
@section('additional_styles')
@include('partials.grid-view-styles')
@endsection
@section('additional_scripts')
@include('partials.grid-view-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(function () {
        $("#table").DataTable({
          responsive: true,
          autoWidth: false,
          paging:false,
          searching:false,
          info:false,
        });});
        function updateStatus(id,accept=false){
            let title='',confirm="";
            if(accept)
             {
                 title="هل تريد قبول طلب التسجيل";
                 confirm="قبول";
             }
            else
            {
                title="هل تريد رفض طلب التسجيل";
                confirm="رفض"
            }
        swal({ title: title,
        text: "",
        icon: "warning",
        buttons:{
            cancel:{
                text: "الغاء",
                value: null,
                visible:true
            },
            confirm:{
                text: confirm,
                value: true,
                className:'confirm-button'
            }
        },

        }).then(isConfirm=>{
        if (isConfirm)
            {
                let url ='',type="";
                if(accept)
                 {
                     url = $(`#accept-route-${id}`).prop('href');
                     type="put";
                 }
                 else
                 {
                     url = $(`#deny-route-${id}`).prop('href');
                     type="delete"
                 }
                token = $('input[name="_token"]').val();
                let data={
                    _token:token
                }
                $.ajax({
                    url:url,
                    type:type,
                    data:data,
                    success:function(response){
                        if(response.status){
                            swal(response.data.msg, "", "success");

                            $('#record-'+id).remove();
                        }
                        else {
                            if(response.data.msg!=undefined)
                            swal(response.data.msg, "", "error");
                            else
                            swal("الرجاء التواصل مع الدعم !", "", "error");
                        }

                    }
                })

            }
                });
        }
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
            <h3 class="card-title">{{ __('pages.List Of').' '.__('pages.Owner Requests') }}</h3>
            {{-- <div class="row justify-content-end">
                <form class="form-inline ml-3" id="filter" action="{{route('owner-request.index')}}">
            <div class="input-group input-group-sm mr-2">
                @if (app()->getLocale()=='ar')
                <div class="input-group-append">
                    <button class="btn btn-navbar"
                        style="background-color: #fff; border:1px solid #CED4DA; border-left:0; color:rgba(0,0,0,.6)"
                        type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <input class="form-control form-control-navbar" type="search" name="search" value=""
                    style="background-color: #fff;" placeholder="{{ __('pages.Search') }}" aria-label="Search">
                @else
                <input class="form-control form-control-navbar" type="search" name="search" value=""
                    style="background-color: #fff;" placeholder="{{ __('pages.Search') }}" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar"
                        style="background-color: #fff; border:1px solid #CED4DA; border-left:0; color:rgba(0,0,0,.6)"
                        type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                @endif
            </div>
            </form>
        </div> --}}
    </div>
    <div class="card-body">
        <div class="row justify-content-end mb-2 ">
            <a href="{{route('owner-request.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                {{ __('pages.Add').' '.__('pages.New Request') }}</a>
        </div>
        <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <th>#</th>
                <th>{{ __('pages.Name') }}</th>
                <th>{{ __('pages.Company') .' '.__('pages.Name') }}</th>
                <th>{{ __('pages.Tax Record') }}</th>
                <th>{{ __('pages.Address') .' '.__('pages.Company')}}</th>
                <th>{{ __('pages.Accept') }}</th>
                <th>{{ __('pages.Deny') }}</th>
            </thead>
            <tbody>
                @forelse ($records as $record)
                <tr id="record-{{ $record->id }}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$record->full_name}}</td>
                    <td>{{$record->place->name}}</td>
                    <td>{{$record->place->tax_record}}</td>
                    <td>{{$record->place->address}}</td>
                    <td>
                        <a href="{{route('owner-request.update',['owner_request'=>$record->id])}}"
                            id="accept-route-{{ $record->id }}"
                            onclick="event.preventDefault();updateStatus({{ $record->id }},true);"
                            class="btn btn-success"><i class="fas fa-check"></i></a>
                    </td>
                    <td>
                        <a href="{{route('owner-request.destroy',['owner_request'=>$record->id])}}"
                            id="deny-route-{{ $record->id }}"
                            onclick="event.preventDefault();updateStatus({{ $record->id }});" class="btn btn-danger"><i
                                class="fas fa-times"></i></a>
                    </td>
                </tr>
                @empty
                <tr style="text-align: center">
                    <td colspan=7>{{ __('pages.No Data') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{-- {{$records->links()}} --}}
        {{ $records->appends(request()->only('search'))->render() }}
    </div>
    <!-- /.card-body -->
    @csrf
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
