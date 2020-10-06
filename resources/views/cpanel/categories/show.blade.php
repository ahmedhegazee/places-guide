@extends('layouts.app')

@section('page_title')
{{__('pages.Categories').' '.$category->name[app()->getLocale()]}}
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
            <h3 class="card-title">{{ __('pages.List Of').' '. __('pages.Categories').' '.$category->name[app()->getLocale()]}}</h3>

        </div>
        <div class="card-body">
            <img src="{{ $category->image }}" alt="">
            <div class="row justify-content-end mb-2">
                <a href="{{route('subcategory.create',['category'=>$category->id])}}" class="btn btn-primary"><i
                        class="fas fa-plus"></i> {{ __('pages.Create').' '. __('pages.Category') }}</a>
            </div>
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>#</th>

                    @foreach($langs as $lang)
                        <th>{{ __('pages.Name').' ('.$lang.')' }}</th>
                    @endforeach
                    <th>{{ __('pages.No').' '.__('pages.Companies') }}</th>
                    <th>{{ __('pages.Edit') }}</th>
                    <th>{{ __('pages.Delete') }}</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr id="record-{{ $record->id }}">
                        <td>{{$loop->iteration}}</td>
                        @foreach($langs as $lang)
                            <td>{{$record->name[$lang]}}</td>
                        @endforeach
                        <td>{{$record->places->count()}}</td>
                        <td>
                            <a href="{{route('subcategory.edit',['category'=>$category->id,'subcategory'=>$record->id])}}"
                                class="btn btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="{{route('subcategory.destroy',['category'=>$category->id,'subcategory'=>$record->id])}}"
                                id="delete-route-{{ $record->id }}"
                                onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            <form id="{{'delete'.$record->id}}"
                                action="{{ route('subcategory.destroy',['category'=>$category->id,'subcategory'=>$record->id]) }}"
                                method="POST" style="display: none;">
                                @method('delete')
                                @csrf
                            </form>
                        </td>
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

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
