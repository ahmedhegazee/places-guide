@extends('layouts.app')
@inject('governs','App\Models\Governorate')
@section('page_title')
{{ __('pages.Owners') }}
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
            <h3 class="card-title">{{ __('pages.List Of').' '. __('pages.Owners') }}</h3>
            <div class="row justify-content-end">
                <form class="form-inline ml-3" id="filter" action="{{route('place-owner.index')}}">
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
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>{{ __('pages.Name') }}</th>
                    <th>{{ __('pages.Company') }}</th>
                    <th>{{ __('pages.Email') }}</th>
                    <th>{{ __('pages.Account Type') }}</th>
                    <th>{{ __('pages.Is Banned') }}</th>
                    <th>{{ __('pages.Change Account Type') }}</th>
                    <th>{{ __('pages.Ban') }}</th>
                    {{-- <th>Date Of Birth</th> --}}
                    <th>{{ __('pages.Delete') }}</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr id="record-{{ $record->id }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->full_name}}</td>
                        <td>{{$record->place->name[app()->getLocale()]}}</td>
                        <td>{{$record->email}}</td>
                        {!! $record->preventAccountTypeAttribute=false !!}
                        <td id="account-{{ $record->id }}">{{$record->account_type}}</td>
                        <td id="status-{{ $record->id }}">{{$record->is_banned}}</td>
                        {{-- <td>{{$record->city->name}}</td> --}}
                        <td class="text-center">
                            <input type="hidden" class="{{ $record->preventAccountTypeAttribute=true }}"
                                id="change-{{ $record->id }}" value="{{ $record->account_type?0:1 }}">
                            <a href="{{route('place-owner.update',['place-owner'=>$record->id])}}"
                                id="update-route-{{ $record->id }}"
                                onclick="event.preventDefault();updateAccountType({{ $record->id }});"
                                class="btn btn-success "><i class="fas fa-arrow-{{$record->account_type?'down':'up'  }}"
                                    id="arrow-{{ $record->id }}"></i></a>
                        </td>
                        <td>
                            <input type="hidden" class="{{ $record->preventGetAttr=true }}" id="ban-{{ $record->id }}"
                                value="{{ $record->is_banned?0:1 }}">
                            <a href="{{route('place-owner.update',['place-owner'=>$record->id])}}"
                                id="update-route-{{ $record->id }}"
                                onclick="event.preventDefault();banUser({{ $record->id }});" class="btn btn-warning"><i
                                    class="fas fa-user-slash"></i></a>
                        </td>
                        <td>
                            <a href="{{route('place-owner.destroy',['place-owner'=>$record->id])}}"
                                id="delete-route-{{ $record->id }}"
                                onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center">
                        <td colspan="8">{{ __('pages.No Data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$records->appends(request()->only('search'))->render()}}
        </div>
        <!-- /.card-body -->
        @csrf
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
