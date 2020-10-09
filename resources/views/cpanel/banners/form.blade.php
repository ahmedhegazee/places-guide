
@foreach($langs as $lang)
    <div class="form-group col-md-5 d-inline-block ">
        <label for="title">{{ __('pages.Title') .' ('.$lang.')' }}</label>
        {!!Form::text('title['.$lang.']',null,[
        'class'=>'form-control',

        ])!!}
    </div>
@endforeach
<div class="clearfix"></div>
@foreach($langs as $lang)
    <div class="form-group col-md-5 d-inline-block ">
        <label for="content">{{ __('main.Banner Content') .' ('.$lang.')' }}</label>
        {!!Form::textarea('content['.$lang.']',null,[
        'class'=>'form-control',

        ])!!}
    </div>
@endforeach
<div class="clearfix"></div>

@include('layouts.image-upload')
<div class="form-group ">
    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
</div>
