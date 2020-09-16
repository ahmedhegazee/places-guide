@inject('category', 'App\Models\WorkerCategory')
@extends('front.master')
@section('content')
<nav class="mb-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">الرئيسيه</a></li>
        <li class="breadcrumb-item active" aria-current="page">اعلانات التوظيف</li>
    </ol>
</nav>
<section class="categories py-2 ">
    <div class="container">
        <div class="row">
            {{-- Filter  --}}
            <div class="col-md-3 col-sm-12">
                <ul class="subcategories mb-4">
                    <a href="{{ route('workads')}}">
                        <li class="d-flex justify-content-between">
                            <div>
                                <span>{{ __('pages.All Jobs') }}</span>
                                <span class="count">({{ $count }})</span>
                            </div><i class="fas fa-chevron-left"></i>
                        </li>
                    </a>
                    @foreach($category->all() as $cat)
                    <a href="{{ route('workads').'?cat='.$cat->id }}">
                        <li class="d-flex justify-content-between">
                            <div><span>{{ $cat->name }}</span>
                                <span class="count">({{ $cat->ads->count() }})</span>
                            </div><i class="fas fa-chevron-left"></i>
                        </li>
                    </a>
                    @endforeach
                </ul>
                <form action="{{ route('workads') }}">
                    <div class="filter mb-4">
                        <h4 class="text-center filter-header">{{ __('pages.Filter') }}</h4>
                        {!!Form::select('govern',$governs,null,array('class'=>'
                        multiple-select','id'=>'govern','onchange'=>'getCities()','placeholder'=>'اختر
                        المحافظة'))!!}
                        <select class="multiple-select last-select" id="city" name="city">
                            <option selected>اختر المدينة</option>
                        </select>
                        <input type="hidden" name="cat" value="{{ request()->cat }}">
                    </div>
                    <button class="btn btn-success filter-button" type="submit">{{ __('pages.Filter') }}</button>
                    {{-- Button --}}
                </form>
            </div>

            {{-- Records --}}

            <div class="row col-md-9 col-sm-12">
                @forelse($records as $record)
                <div class="col-md-6 col-sm-12">
                    <div class="card mb-4 shadow-sm">
                        <a href="{{ route('discount.show',['place'=>$record->id]) }}" class="category">
                            <div class="position-relative category-content">
                                @if ($record->main_image=='images/company.png')
                                <img src="{{asset($record->place->main_image)}}" width="100%" height="200px" alt="">
                                @else
                                <img src="{{$record->place->main_image }}" width="100%" height="200px" alt="">
                                @endif

                                <span>{{ $record->place->name }}</span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-text">{{ $record->title }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="alert alert-danger col-12" style="height:50px" role="alert">
                    {{ __('messages.No Ads') }}
                </div>
                @endforelse
            </div>

        </div>

        {{-- pagination --}}
        <div class="row justify-content-center">
            {{ $records->appends(['city'=>request()->city,'cat'=>request()->cat])->links() }}
        </div>
    </div>
</section>
@endsection

{{--
@section('slider')
<!--main-header-->
<div class="category-header" style="background:url({{ $category->image }})">
<div class="row justify-content-center align-content-center">
    <h2>{{ $category->name }}</h2>
</div>

</div>
<!--End main-header-->
@endsection --}}

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
            $('.multiple-select').select2({
                dir: 'rtl'
            });
        });

        function getCities() {
            let govern = $('#govern').val();
            // console.log(govern);

            $.ajax({
                url: `${location.origin}/api/v1/cities?govern=${govern}`
            }).done(function (data) {
                let cities = data.data;

                let defaultElement = $('#city').children().first();
                $('#city').empty();
                $(defaultElement).appendTo('#city');
                // $(`<option selected="" disabled=""></option>`).appendTo('#city');
                cities.forEach(function (city) {
                    $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
                });
            })
        }

        function getSubCategories() {
            let category = $('#category').val();
            // console.log(govern);

            $.ajax({
                url: `${location.origin}/api/v1/sub-categories?category=${category}`
            }).done(function (data) {
                let cities = data.data;

                let defaultElement = $('#sub_category').children().first();
                $('#sub_category').empty();
                $(defaultElement).appendTo('#sub_category');
                // $(`<option selected="" disabled=""></option>`).appendTo('#city');
                cities.forEach(function (city) {
                    $(`<option value=${city.id}>${city.name}</option>`).appendTo('#sub_category');
                });
            })
        }
        $('.heart-icon').click(function () {
            var icon = $(this).find('i');
            let post = $(this).attr('data-post');
            let token = $('input[name="_token"]').val();
            $.ajax({
                url: '/favourite/post',
                type: 'post',
                data: {
                    post: post,
                    _token: token
                },
                success: function (response) {
                    if ($(this).hasClass('fas')) {
                        $(this).removeClass('fas').addClass('far');
                    } else {
                        $(this).removeClass('far').addClass('fas');
                    }
                }
            });
        });
</script>

@endpush
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: transparent !important;
        color: #777 !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__choice__remove {
        color: #ccc !important;

    }

    .select2-selection__choice__remove:hover {
        background-color: transparent !important;
        color: #777 !important;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-results__option {
        text-align: justify;
    }
</style>
<style>
    .breadcrumb {
        background: #2d3e50;
        border: none
    }

    .breadcrumb a {
        color: #fff;
    }

    .breadcrumb .active {
        color: #D0934D;
    }

    .category-header {
        overflow: hidden;
        background-repeat: no-repeat !important;
        height: 70vh;
        background-size: cover !important;
        background-attachment: fixed !important;
    }

    .category-header .row {
        height: 100%;
        color: #fff;
    }

    .category-header h2 {
        font-size: 4rem;
        font-weight: bold;
    }

    .category h3 {
        font-size: 1.5rem;
    }

    .subcategories {
        list-style: none;
    }

    .subcategories,
    .filter {
        border: 1px solid #aaa;
        border-radius: 5px;
    }

    .subcategories li {
        border-bottom: 1px solid #aaa;
        color: #777;
        background: #fffefede;
        padding: 5px 10px;
    }

    .subcategories a:last-of-type li {
        border: none;
        border-radius: 0 0 5px 5px;
    }

    .subcategories a:first-of-type li {
        border-radius: 5px 5px 0 0;
    }

    .subcategories li:hover,
    .subcategories ul .active {
        color: #000;
        background: #f9f9f9
    }

    .fa-chevron-left {
        padding-top: 10px;
        font-size: .25rem;
    }

    .subcategories li .count,
    .filter .filter-header,
    .fa-chevron-left {
        color: #777;
    }

    .filter {
        padding: 30px 20px;
        padding-bottom: 10px;

    }

    .filter .filter-header {
        margin: 0;
        font-size: 1rem;
        margin-bottom: 10%;
        border-bottom: 1px solid #aaa;
        padding-bottom: 15px;
    }

    .select2-selection {
        border-radius: 2px !important;
        margin-bottom: 10% !important;
    }

    @media(max-width: 768px) {
        .category-header {
            height: 38vh;
        }
    }

    .filter-button {
        border-radius: 0px;
        width: 100%;
    }

    .categories {
        min-height: 90vh;
    }

    .discounts-count {
        font-size: 1rem !important;
        position: absolute !important;
        top: 5%;
        left: -3%;
        bottom: unset !important;
        right: unset !important;
        padding: 8px 10px;
    }
</style>
@endpush
