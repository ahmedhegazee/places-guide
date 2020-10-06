
@foreach($langs as $lang)
    <div class="form-group col-md-5 d-inline-block ">
        <label for="name">{{ __('pages.Name') .' ('.$lang.')' }}</label>
        {!!Form::text('name['.$lang.']',null,[
        'class'=>'form-control',

        ])!!}
    </div>
@endforeach
<div class="clearfix"></div>

@include('layouts.image-upload')
<div class="form-group ">
    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
</div>
