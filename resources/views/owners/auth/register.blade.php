@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{__('main.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.join us')}}</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
<section class="signup ">

    <div class="container">
        @include('partials.validation-errors')
        @include('flash::message')
        <div class="py-4 mb-4">
            <form action="{{ url('/join-us') }}" class="w-75 m-auto" method="POST">
                @csrf
                {{-- <input type="text" name="booldType" class="form-control my-3" placeholder="فصيلة الدم"> --}}




                <div id="first-step">
                    <div class="col-md-10"><input type="text" name="full_name"
                            class="form-control my-3 @error('full_name') is-invalid @enderror"
                            value="{{ old('full_name') }}" placeholder="{{__('pages.Owner Name')}}"></div>
                    <div class="col-md-10"><input type="email" name="email" class="form-control my-3 @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="{{__('main.email')}}"></div>
                    <div class="col-md-10">
                        <input type="password" name="password"
                               class="form-control my-3 @error('password') is-invalid @enderror " placeholder="{{__('main.password')}}">

                    </div>
                                        <div class="col-md-10">
                                            <input type="password" name="password_confirmation"
                                                   class="form-control my-3 @error('password_confirmation') is-invalid @enderror "
                                                   placeholder="{{__('main.confirm password')}}">
                                        </div>
                    <div class="form-group" style="text-align: right;">

                        {!!Form::radio('account_type',0,true)!!}
                        <label for="account_type">{{__('pages.Free Account')}}</label>
                        &nbsp;&nbsp;&nbsp;
                        {!!Form::radio('account_type',1)!!}
                        <label for="account_type">{{__('pages.Premium Account')}}</label>
                    </div>
                </div>
                <div id="second-step" style="display:none">
                    @foreach($langs as $lang)
                    <div class="col-md-5 d-inline-block p-0 mr-2" style="text-align: justify!important;">
                        <input type="text" name="name{{'['.$lang.']'}}" class="form-control my-3 @error('name['.$lang.']') is-invalid @enderror"
                            value="{{ old('name['.$lang.']') }}" placeholder="{{__('pages.Place Name').'('.$lang.')'}}"></div>
                    @endforeach
                    <div class="clearfix"></div>
                        <div class="col-md-10">
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="form-control my-3 @error('phone') is-invalid @enderror " placeholder="{{__('pages.Place Phone')}}">
                        </div>
                    <div class="col-md-10">
                        <input type="text" name="tax_record"
                            class="form-control my-3 @error('tax_record') is-invalid @enderror"
                            value="{{ old('tax_record') }}" placeholder="{{__('pages.Tax Record')}}"></div>
                        @foreach($langs as $lang)
                    <div class="col-md-5 p-0 d-inline-block mr-2"><input type="text" name="address{{'['.$lang.']'}}"
                            class="form-control my-3 @error('address['.$lang.']') is-invalid @enderror"
                            value="{{ old('address['.$lang.']') }}" placeholder="{{__('pages.Place Address').'('.$lang.')'}}"></div>
                        @endforeach
                        <div class="clearfix"></div>
                        @foreach($langs as $lang)
                        <div class="form-group col-md-5 d-inline-block">
                        {{-- <label for="about">{{ __('pages.Company About') }}</label> --}}
                        {!!Form::textarea('about['.$lang.']',null,[
                        'class'=>'form-control',
                        'placeholder'=>__('pages.Company About').'('.$lang.')',

                        ])!!}
                    </div>
                        @endforeach
                        <div class="clearfix"></div>
                </div>
                <div id="third-step" style="display:none; text-align:right">
                    <div class="form-group">
                        {{-- <label for="govern">{{ __('pages.Govern') }}</label> --}}
                        {!!Form::select('govern',$governs,null,array('class'=>'form-control
                        multiple-select','id'=>'govern','onchange'=>'getCities()','placeholder'=>__('main.choose govern orate')))!!}
                    </div>
                    <div class="form-group">
                        {{-- <label for="city">{{ __('pages.City') }}</label> --}}
                        <select class="form-control multiple-select" id="city" name="city_id">
                            <option selected>{{__('main.choose city')}}</option>
                        </select>

                    </div>
                    <div class="form-group">
                        {{-- <label for="category_id">{{ __('pages.Category') }}</label> --}}
                        {!!Form::select('category_id',$categories,null,array('class'=>'form-control
                        multiple-select','id'=>'category','onchange'=>'getSubCategories()','placeholder'=>__('main.choose category')))!!}
                    </div>
                    <div class="form-group">
                        {{-- <label for="sub_category_id">{{ __('pages.SubCategory') }}</label> --}}
                        <select class="form-control multiple-select" id="sub_category" name="sub_category_id">
                            <option selected value="">{{__('main.choose subcategory')}}</option>

                        </select>

                    </div>
                    <div class="form-group">
                        {{-- <label for="opened_time">{{ __('pages.Opened Time') }}</label> --}}
                        <input type="time" name="opened_time" class="form-control" style="text-align:end"
                            id="opened_time">
                    </div>
                    <div class="form-group">
                        {{-- <label for="closed_time">{{ __('pages.Closed Time') }}</label> --}}
                        <input type="time" name="closed_time" class="form-control" style="text-align:end"
                            id="closed_time">
                    </div>
                    <div class="form-group">
                        {{-- <label for="closed_days">{{ __('pages.Closed Days') }}</label> --}}
                        {!!Form::select('closed_days',$days,null,array('multiple'=>'multiple','name'=>'closed_days[]','class'=>'form-control
                        multiple-select'))!!}
                    </div>

                </div>
                <div class="row justify-content-end pl-3">

                    <button id="prevBtn" class="btn btn-primary ml-2" type="button" style="display:none"
                        onclick="showPrev()">{{__('main.Prev')}}</button>
                    <button id="nextBtn" class="btn btn-primary " type="button" onclick="showNext()">{{__('main.Next')}}</button>
                    <button id="submitBtn" class="btn btn-success" id="submit" style="display:none"
                        type="submit">{{ __('pages.Submit') }}</button>

                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    let step = 0,
        steps = ['first-step', 'second-step', 'third-step'];

    function showNext() {

        document.getElementById(steps[step]).style.display = "none";
        // console.log(document.getElementById('step1'));
        step++;
        if (step > 0) {
            document.getElementById("prevBtn").style.display = "block";
        }
        if (step == steps.length - 1) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "block";
        }
        document.getElementById(steps[step]).style.display = "block";

    }

    function showPrev() {
        document.getElementById(steps[step]).style.display = "none";
        step--;
        document.getElementById(steps[step]).style.display = "block";
        // console.log(document.getElementById('step1'));
        if (step == 0) {
            document.getElementById("prevBtn").style.display = "none";
        }
        if (step < steps.length - 1) {
            document.getElementById("nextBtn").style.display = "block";
            document.getElementById("submitBtn").style.display = "none";
        }
    }
    $(document).ready(function () {
        $('.multiple-select').select2({
            dir: 'rtl'
        });
    });
    function getCities(){
              let govern = $('#govern').val();
            //   console.log(govern);

              $.ajax({
                url:`${location.origin}/api/v1/cities?govern=${govern}`
              }).done(function(data){
                let cities = data.data;

               let defaultElement= $('#city').children().first();
                $('#city').empty();
                $(defaultElement).appendTo('#city');
            //    $(`<option selected="" disabled=""></option>`).appendTo('#city');
                cities.forEach(function(city){
                  $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
                });
              })
            }
    function getSubCategories(){
              let category = $('#category').val();
            //   console.log(govern);

              $.ajax({
                url:`${location.origin}/api/v1/sub-categories?category=${category}`
              }).done(function(data){
                let categories = data.data;

               let defaultElement= $('#sub_category').children().first();
                $('#sub_category').empty();
                $(defaultElement).appendTo('#sub_category');
            //    $(`<option selected="" disabled=""></option>`).appendTo('#city');
                if(categories.length==0)
                $('<option value="">لا يوجد تصنيف</option>').appendTo('#sub_category');
                else
                categories.forEach(function(category){
                  $(`<option value=${category.id}>${category.name}</option>`).appendTo('#sub_category');
                });
              })
    }

</script>
@endpush
@push('styles')
<style>
    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 5px);
        padding: 8px;
    }

    .fa-chevron-down {
        top: 15px !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: transparent !important;
        color: #000 !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__choice__remove {
        color: #ccc !important;

    }

    .select2-selection__choice__remove:hover {
        background-color: transparent !important;
        color: #000 !important;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-results__option {
        text-align: justify;
    }
</style>
@endpush
