@extends('owners.app')
@section('page_title')
{{ __('pages.Edit').' '.__('pages.Company Data') }}
@endsection
@section('additional_styles')
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
@endsection
@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    let step = 0,
        steps = [];
    let accountType = document.getElementById('account_type').value;
    if (parseInt(accountType))
        steps = ['first-step', 'second-step', 'third-step'];
    else
        steps = ['first-step', 'second-step'];
    // console.log(steps);
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

    function getCities() {
        let govern = $('#govern').val();
        //   console.log(govern);

        $.ajax({
            url: `${location.origin}/api/v1/cities?govern=${govern}`
        }).done(function (data) {
            let cities = data.data;

            let defaultElement = $('#city').children().first();
            $('#city').empty();
            $(defaultElement).appendTo('#city');
            //    $(`<option selected="" disabled=""></option>`).appendTo('#city');
            cities.forEach(function (city) {
                $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
            });
        })
    }

    function getSubCategories() {
        let category = $('#category').val();
        //   console.log(govern);

        $.ajax({
            url: `${location.origin}/api/v1/sub-categories?category=${category}`
        }).done(function (data) {
            let cities = data.data;

            let defaultElement = $('#sub_category').children().first();
            $('#sub_category').empty();
            $(defaultElement).appendTo('#sub_category');
            //    $(`<option selected="" disabled=""></option>`).appendTo('#city');
            cities.forEach(function (city) {
                $(`<option value=${city.id}>${city.name}</option>`).appendTo('#sub_category');
            });
        })
    }
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_TOKEN') }}&callback=initMap&libraries=&v=weekly"
    defer>
</script>
<script>
    let map;
    document.onload = function () {
        initMap();
    }

    function initMap() {
        let long = document.getElementById('long');
        let lat = document.getElementById('lat');
        // console.log(long);
        if (long != null && lat != null) {
            lat = lat.value;
            long = long.value;
            let center = {};
            if (long == 'nope' || lat == 'nope') {
                center = {
                    lat: 52.377956,
                    lng: 4.897070
                };
            } else {
                lat = parseFloat(lat);
                long = parseFloat(long);
                center = {
                    lat: lat,
                    lng: long
                }
                placeMarker(center);
            }

            map = new google.maps.Map(document.getElementById("map"), {
                center: center,
                zoom: 8
            });
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
            });
        }
        let marker = null;

        function placeMarker(location) {
            if (marker != null)
                marker.setMap(null);
            // console.log(location.lat());
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
             long = document.getElementById('long');
             lat = document.getElementById('lat');
            long.value = location.lng();
            lat.value = location.lat();
            map.setCenter(location);
        }
    }
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">

        <div class="card-body">

            @include('partials.validation-errors')
            {!!
            Form::model($model,[
            'route'=>'owner.change-info-company',
            'method'=>'post',
            'files'=>true,
            ])
            !!}
            @csrf
            <div id="first-step">
                <div class="form-group">
                    <label for="name">{{ __('pages.Company') .' '. __('pages.Name') }}</label>
                    {!!Form::text('name',null,[
                    'class'=>'form-control',

                    ])!!}
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('pages.Company') .' '. __('pages.Phone') }}</label>
                    {!!Form::text('phone',null,[
                    'class'=>'form-control',

                    ])!!}
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('pages.Tax Record') }}</label>
                    {!!Form::text('tax_record',null,[
                    'class'=>'form-control',

                    ])!!}
                </div>
                <div class="form-group">
                    <label for="address">{{ __('pages.Company') .' '. __('pages.Address') }}</label>
                    {!!Form::text('address',null,[
                    'class'=>'form-control',

                    ])!!}
                </div>
                <div class="form-group">
                    <label for="about">{{ __('pages.Company About') }}</label>
                    {!!Form::textarea('about',null,[
                    'class'=>'form-control',

                    ])!!}
                </div>
            </div>
            <div id="second-step" style="display:none">
                <div class="form-group">
                    <label for="govern">{{ __('pages.Govern') }}</label>
                    {!!Form::select('govern',$governs,null,array('class'=>'form-control
                    multiple-select','id'=>'govern','onchange'=>'getCities()','placeholder'=>'اختر المحافظة'))!!}
                </div>
                <div class="form-group">
                    <label for="city">{{ __('pages.City') }}</label>
                    <select class="form-control multiple-select" id="city" name="city_id">
                        <option selected>اختر المدينة</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="category">{{ __('pages.Category') }}</label>
                    {!!Form::select('category',$categories,null,array('class'=>'form-control
                    multiple-select','id'=>'category','onchange'=>'getSubCategories()','placeholder'=>'اختر
                    التصنيف'))!!}
                </div>
                <div class="form-group">
                    <label for="sub_category_id">{{ __('pages.SubCategory') }}</label>
                    <select class="form-control multiple-select" id="sub_category" name="sub_category_id">
                        <option selected>اختر التصنيف الفرعي</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="opened_time">{{ __('pages.Opened Time') }}</label>
                    <input type="time" name="opened_time" class="form-control" value="{{ old('opened_time')??'' }}"
                        style="text-align:end" id="opened_time">
                </div>
                <div class="form-group">
                    <label for="closed_time">{{ __('pages.Closed Time') }}</label>
                    <input type="time" name="closed_time" class="form-control" value="{{ old('closed_time')??'' }}"
                        style="text-align:end" id="closed_time">
                </div>
                <div class="form-group">
                    <label for="closed_days">{{ __('pages.Closed Days') }}</label>
                    {!!Form::select('closed_days',$days,null,array('multiple'=>'multiple','name'=>'closed_days[]','class'=>'form-control
                    multiple-select'))!!}
                </div>

            </div>
            @if(auth('owners')->user()->account_type)
            <div id="third-step" style="display:none">
                <div class="row col-md-6">
                    @if($model->main_image=='images/company.png')
                    <img src="{{ asset($model->main_image) }}" alt="">
                    @else
                    <img src="{{ $model->main_image }}" alt="">
                    @endif

                </div>
                <div class="form-group">
                    <label for="main_image">{{ __('pages.Comapny Logo') }}</label>
                    <input type="file" name="main_image" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <label for="website">{{ __('pages.Website') }}</label>
                    <input type="url" name="website" class="form-control">
                </div>
                <div class="form-group">
                    <label for="youtube">{{ __('pages.Website') }}</label>
                    <input type="url" name="youtube" class="form-control">
                </div>
                <div class="form-group">
                    <label for="facebook">{{ __('pages.Facebook') }}</label>
                    <input type="url" name="facebook" class="form-control">
                </div>
                <div class="form-group">
                    <label for="twitter">{{ __('pages.Twitter') }}</label>
                    <input type="url" name="twitter" class="form-control">
                </div>
                <div class="form-group">
                    <label for="instagram">{{ __('pages.Instagram') }}</label>
                    <input type="url" name="instagram" class="form-control">
                </div>
                <div class="form-group">
                    <label for="location">{{ __('pages.Company Location on Map') }}</label>
                    <input type="hidden" id="lat" name="latitude" value="{{ $model->latitude??'nope' }}">
                    <input type="hidden" id="long" name="longitude" value="{{ $model->longitude??'nope' }}">
                </div>
                <div class="row">
                    <div id="map" style="width:80%;height:80vh;"></div>
                </div>

            </div>
            @endif


            <input type="hidden" id="account_type" value="{{ auth('owners')->user()->account_type }}">
            <div class="row justify-content-end">
                <button id="nextBtn" class="btn btn-primary ml-2" type="button" onclick="showNext()">التالي</button>
                <button id="prevBtn" class="btn btn-primary" type="button" style="display:none"
                    onclick="showPrev()">السابق</button>
                <button id="submitBtn" class="btn btn-primary" id="submit" style="display:none"
                    type="submit">{{ __('pages.Submit') }}</button>

            </div>
            {!!Form::close()!!}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
