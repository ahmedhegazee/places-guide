{{-- TODO Js Validation --}}
<div id="first-step">
    <div class="form-group col-md-10">
        <label for="full_name ">{{ __('pages.Name') }}</label>
        {!!Form::text('full_name',null,[
        'class'=>'form-control ',
        ])!!}
    </div>
    <div class="form-group col-md-10">
        <label for="email">{{ __('pages.Email') }}</label>
        {!!Form::email('email',null,[
        'class'=>'form-control ',

        ])!!}
    </div>
    <div class="form-group col-md-10">
        <label for="password">{{ __('pages.Password') }}</label>
        {!!Form::password('password',[
        'class'=>'form-control',

        ])!!}
    </div>
    <div class="form-group col-md-10">
        <label for="password_confirmation">{{ __('pages.Confirm').' '. __('pages.Password') }}</label>
        {!!Form::password('password_confirmation',[
        'class'=>'form-control',

        ])!!}
    </div>
    <div class="form-group col-md-10">

        {!!Form::radio('account_type',0,true)!!}
        <label for="account_type">عضوية فضية</label>
        &nbsp;&nbsp;&nbsp;
        {!!Form::radio('account_type',1)!!}
        <label for="account_type">عضوية الماسية</label>
    </div>
</div>
<div id="second-step" style="display:none">
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
        <label for="phone">{{ __('pages.Place Phone') }}</label>
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
<div id="third-step" style="display:none">
    <div class="form-group col-md-10">
        <label for="govern">{{ __('pages.Govern') }}</label>
        {!!Form::select('govern',$governs,null,array('class'=>'form-control
        multiple-select','id'=>'govern','onchange'=>'getCities()','placeholder'=>'اختر المحافظة'))!!}
    </div>
    <div class="form-group col-md-10">
        <label for="city">{{ __('pages.City') }}</label>
        <select class="form-control multiple-select" id="city" name="city_id">
            <option selected>{{__('main.choose city')}}</option>
        </select>

    </div>
    <div class="form-group col-md-10">
        <label for="category_id">{{ __('pages.Category') }}</label>
        {!!Form::select('category_id',$categories,null,array('class'=>'form-control
        multiple-select','id'=>'category','onchange'=>'getSubCategories()','placeholder'=>__('main.choose category')))!!}
    </div>
    <div class="form-group col-md-10">
        <label for="sub_category_id">{{ __('pages.SubCategory') }}</label>
        <select class="form-control multiple-select" id="sub_category" name="sub_category_id">
            <option selected value="">{{__('main.choose subcategory')}}</option>

        </select>

    </div>
    <div class="form-group col-md-10">
        <label for="opened_time">{{ __('pages.Opened Time') }}</label>
        <input type="time" name="opened_time" class="form-control" style="text-align:end" id="opened_time">
    </div>
    <div class="form-group col-md-10">
        <label for="closed_time">{{ __('pages.Closed Time') }}</label>
        <input type="time" name="closed_time" class="form-control" style="text-align:end" id="closed_time">
    </div>
    <div class="form-group col-md-10">
        <label for="closed_days">{{ __('pages.Closed Days') }}</label>
        {!!Form::select('closed_days',$days,null,array('multiple'=>'multiple','name'=>'closed_days[]','class'=>'form-control
        multiple-select'))!!}
    </div>

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
@endsection
