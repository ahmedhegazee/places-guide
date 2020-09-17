<div class="form-group">
    <label for="name"> {{ __('pages.Name') }}</label>
    {!!Form::text('name',null,[
    'class'=>'form-control'
    ])!!}
</div>
@include('layouts.image-upload')
<div class="form-group ">
    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
</div>
