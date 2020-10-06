@foreach($langs as $lang)
    <div class="form-group col-md-5 d-inline-block ">
        <label for="name">{{ __('pages.Title') .' ('.$lang.')' }}</label>
        {!!Form::text('title['.$lang.']',null,[
        'class'=>'form-control',

        ])!!}
    </div>
@endforeach
<div class="clearfix"></div>

<div class="form-group">
    <label for="quantity"> {{ __('pages.Quantity') }}</label>
    {!!Form::number('quantity',null,[
    'class'=>'form-control',
    'required'
    ])!!}
</div>
<div class="form-group">
    <label for="phone"> {{ __('pages.Phone To Communicate') }}</label>
    {!!Form::number('phone',null,[
    'class'=>'form-control',
    'required'
    ])!!}
</div>
<div class="form-group">
    <label for="work_category_id">{{ __('pages.Category') }}</label>
    {!!Form::select('work_category_id',$categories,null,array('class'=>'form-control
    multiple-select','placeholder'=>__('main.choose category')))!!}
</div>
@foreach($langs as $lang)
    <div class="form-group col-md-5 d-inline-block ">
        <label for="content">{{ __('pages.Ad About') .' ('.$lang.')' }}</label>
        {!!Form::textarea('content['.$lang.']',null,[
        'class'=>'form-control',
        'required'
        ])!!}
    </div>
@endforeach
<div class="clearfix"></div>
<div class="form-group ">
    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
</div>
@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.multiple-select').select2({
        dir: 'rtl'
        });
        });
</script>
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
