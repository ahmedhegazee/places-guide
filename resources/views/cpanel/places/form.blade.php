{{-- TODO Js Validation --}}
<div id="first-step">
    @foreach($langs as $lang)
    <div class="form-group col-md-5 d-inline-block ">
        <label for="name">{{ __('pages.Place Name') .' ('.$lang.')' }}</label>
        {!!Form::text('name['.$lang.']',null,[
        'class'=>'form-control',

        ])!!}
    </div>
    @endforeach
    <div class="clearfix"></div>
    <div class="form-group col-md-10">
        <label for="phone">{{ __('pages.Place Phone')  }}</label>
        {!!Form::text('phone',null,[
        'class'=>'form-control',

        ])!!}
    </div>
    <div class="form-group col-md-10">
        <label for="phone">{{ __('pages.Tax Record') }}</label>
        {!!Form::text('tax_record',null,[
        'class'=>'form-control',

        ])!!}
    </div>
        @foreach($langs as $lang)
            <div class="form-group col-md-5 d-inline-block ">
                <label for="address">{{ __('pages.Place Address') .' ('.$lang.')' }}</label>
                {!!Form::text('address['.$lang.']',null,[
                'class'=>'form-control',

                ])!!}
            </div>
        @endforeach
        <div class="clearfix"></div>
        @foreach($langs as $lang)
            <div class="form-group col-md-5 d-inline-block ">
                <label for="address">{{ __('pages.Company About').' ('.$lang.')' }}</label>
                {!!Form::textarea('about['.$lang.']',null,[
                'class'=>'form-control',

                ])!!}
            </div>
        @endforeach
        <div class="clearfix"></div>
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
        <label for="category_id">{{ __('pages.Category') }}</label>
        {!!Form::select('category_id',$categories,null,array('class'=>'form-control
        multiple-select','id'=>'category','onchange'=>'getSubCategories()','placeholder'=>'اختر التصنيف'))!!}
    </div>
    <div class="form-group">
        <label for="sub_category_id">{{ __('pages.SubCategory') }}</label>
        <select class="form-control multiple-select" id="sub_category" name="sub_category_id">
            <option selected value="">اختر التصنيف الفرعي</option>

        </select>

    </div>
    <div class="form-group">
        <label for="opened_time">{{ __('pages.Opened Time') }}</label>
        <input type="time" name="opened_time" class="form-control" style="text-align:end" id="opened_time">
    </div>
    <div class="form-group">
        <label for="closed_time">{{ __('pages.Closed Time') }}</label>
        <input type="time" name="closed_time" class="form-control" style="text-align:end" id="closed_time">
    </div>
    <div class="form-group">
        <label for="closed_days">{{ __('pages.Closed Days') }}</label>
        {!!Form::select('closed_days',$days,null,array('multiple'=>'multiple','name'=>'closed_days[]','class'=>'form-control
        multiple-select'))!!}
    </div>

</div>
<div id="third-step" style="display:none">
    <div class="row col-md-6">

        @if(Route::is('place.create'))
        <img src="{{ asset('images/company.png') }}" alt="">
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
    {{--

        --}}

    @if (!is_null($model->owner))
    @if ($model->owner->account_type)
    <div class="form-group">
        <label for="location">{{ __('pages.Company Location on Map') }}</label>
        <input type="hidden" id="lat" name="latitude" value="{{ $model->latitude??'nope' }}">
        <input type="hidden" id="long" name="longitude" value="{{ $model->longitude??'nope' }}">
    </div>
    <div class="row">
        <div id="map" style="width:80%;height:80vh;"></div>
    </div>
    @endif
    @else
    <input type="hidden" id="lat" name="latitude" value="{{ $model->latitude??'nope' }}">
    <input type="hidden" id="long" name="longitude" value="{{ $model->longitude??'nope' }}">
    <div class="row">
        <div id="map" style="width:80%;height:80vh;"></div>
    </div>
    @endif



</div>
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
        steps = ['first-step', 'second-step','third-step'];

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
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_TOKEN') }}&callback=initMap&libraries=&v=weekly"
    defer>
</script>
<script>
    let map,center;
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
             center = {};
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
                // placeMarker(center);
            }

            map = new google.maps.Map(document.getElementById("map"), {
                center: center,
                zoom: 16
            });
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
            });
        }
        let marker = null;
placeMarker(center);
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
