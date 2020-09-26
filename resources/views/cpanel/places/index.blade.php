@extends('layouts.app')
@inject('governs','App\Models\Governorate')
@section('page_title')
{{ __('pages.Companies') }}
@endsection
@section('additional_styles')
@include('partials.grid-view-styles')
@endsection
@section('additional_scripts')
@include('partials.grid-view-scripts')
@include('partials.delete')
<script>
    function getCities(){
let govern = $('#govern').val();
// console.log(govern);

$.ajax({
url:`${location.origin}/api/v1/cities?govern=${govern}`
}).done(function(data){
let cities = data.data;

let defaultElement= $('#city').children().first();
$('#city').empty();
$(defaultElement).appendTo('#city');
// $(`<option selected="" disabled=""></option>`).appendTo('#city');
cities.forEach(function(city){
$(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
});
})
}
function getSubCategories(){
let category = $('#category').val();
// console.log(category);

$.ajax({
url:`${location.origin}/api/v1/sub-categories?category=${category}`
}).done(function(data){
let categories = data.data;

let defaultElement= $('#subcategory').children().first();
$('#subcategory').empty();
$(defaultElement).appendTo('#subcategory');
// $(`<option selected="" disabled=""></option>`).appendTo('#city');
categories.forEach(function(subcategory){
$(`<option value=${subcategory.id}>${subcategory.name}</option>`).appendTo('#subcategory');
});
})
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
            <h3 class="card-title">{{ __('pages.List Of').' '. __('pages.Companies') }}</h3>
            <div class="row justify-content-end">
                <form class="form-inline ml-3" id="filter" action="{{route('place.index')}}">
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
                    {{-- <select class="form-control custom-select mr-2" onchange="document.getElementById('filter').submit();" name="blood"
                        id="blood">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.Blood Type') }}</option>
                    @foreach ($bloodTypes->all() as $bloodType)
                    <option value={{$bloodType->id}}>{{$bloodType->name}}</option>
                    @endforeach
                    </select> --}}
                    <select class="form-control custom-select mr-2" onchange="getCities()" name="govern" id="govern">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.Govern') }}</option>
                        @foreach ($governs->all() as $govern)
                        <option value={{$govern->id}}>{{$govern->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control custom-select mr-2"
                        {{-- onchange="document.getElementById('filter').submit();" --}} name="city" id="city">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.City') }}</option>
                    </select>
                    <select class="form-control custom-select mr-2" onchange="getSubCategories()" name="category"
                        id="category">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.Category') }}</option>
                        @foreach ($categories->all() as $category)
                        <option value={{$category->id}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control custom-select mr-2"
                        {{-- onchange="document.getElementById('filter').submit();" --}} name="subcategory"
                        id="subcategory">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.SubCategory') }}</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-end mb-2 ">
                <a href="{{route('place.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    {{ __('pages.Add').' '.__('pages.Company') }}</a>
            </div>
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>{{ __('pages.Name') }}</th>
                    <th>{{ __('pages.Owner') }}</th>
                    <th>{{ __('pages.City') }}</th>
                    <th>{{ __('pages.Category') }}</th>
                    <th>{{ __('pages.SubCategory') }}</th>
                    <th>{{ __('pages.Is Best') }}</th>
                    <th>{{ __('pages.Best') }}</th>
                    <th>{{ __('pages.Photos') }}</th>
                    <th>{{ __('pages.Show') }}</th>
                    <th>{{ __('pages.Edit') }}</th>
                    <th>{{ __('pages.Delete') }}</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr id="record-{{ $record->id }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->city->name}}</td>
                        <td>{{$record->owner->full_name??'لا يوجد مالك'}}</td>
                        <td>{{$record->category->name}}</td>
                        <td>{{$record->subCategory->name??'لا يوجد تصنيف فرعي'}}</td>
                        {!! $record->preventIsBest=false !!}
                        <td id="is-best-{{ $record->id }}">{{$record->is_best}}</td>
                        <td class="text-center">
                            <input type="hidden" class="{{ $record->preventIsBest=true }}" id="best-{{ $record->id }}"
                                value="{{ $record->is_best?0:1 }}">
                            <a href="{{route('place.best',['place'=>$record->id])}}" id="update-route-{{ $record->id }}"
                                onclick="event.preventDefault();isBest({{ $record->id }});" class="btn btn-success "><i
                                    class="{{$record->is_best?'fas':'far'}} fa-star"
                                    id="favourite-{{ $record->id }}"></i></a>
                        </td>
                        <td>
                            <a href="{{route('place.photos',['place'=>$record->id])}}" class="btn btn-primary"><i
                                    class="fas fa-images"></i></a>
                        </td>
                        <td>
                            <a href="{{route('place.show',['place'=>$record->id])}}" class="btn btn-primary"><i
                                    class="fas fa-eye"></i></a>
                        </td>

                        <td>
                            <a href="{{route('place.edit',['place'=>$record->id])}}" class="btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                        </td>

                        <td>
                            <a href="{{route('place.destroy',['place'=>$record->id])}}"
                                id="delete-route-{{ $record->id }}"
                                onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center">
                        <td colspan=11>{{ __('pages.No Data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$records->appends(request()->only(['search','city']))->render()}}
        </div>
        <!-- /.card-body -->
        @csrf
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
