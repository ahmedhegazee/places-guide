@if (Route::currentRouteName()=='photo.create'||Route::currentRouteName()=='dashboard.photo.create')
<div class="form-group">
    <label for="file">{{ __('pages.Upload File')}}</label>
    {!!Form::file('file[]',[
    'class'=>'form-control',
    'multiple'=>'multiple'
    ])!!}
</div>
@else
<div class="form-group">
    <label for="file">{{ __('pages.Upload File')}}</label>
    {!!Form::file('file',[
    'class'=>'form-control',
    ])!!}
</div>
@endif
