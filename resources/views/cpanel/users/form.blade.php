<div class="form-group">
    <label for="name">{{ __('pages.Name') }}</label>
    {!!Form::text('name',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="email">{{ __('pages.Email') }}</label>
    {!!Form::email('email',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="password">{{ __('pages.Password') }}</label>
    {!!Form::password('password',[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="password_confirmation">{{ __('pages.Confirm').' '. __('pages.Password')  }}</label>
    {!!Form::password('password_confirmation',[
    'class'=>'form-control'
    ])!!}
</div>
{{-- <div class="form-group">
    <label for="permissions">Roles</label>
    <div class="row">
        @foreach ($rol->all() as $role)
        <div class="col-3-sm">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="roles_list[]" value="{{$role->id}}"
@if($model->hasRole($role->name))
checked
@endif
>
</div>
</div>
<input type="text" class="form-control" value="{{$role->display_name}}" disabled>
</div>
</div>
@endforeach
</div>
</div> --}}

<div class="form-group">
    <label for="roles_list">{{ __('pages.Roles') }}</label>
    {!!Form::select('roles_list',$roles,null,array('multiple'=>'multiple','name'=>'roles_list[]','class'=>'form-control
    multiple-select'))!!}
</div>
<div class="form-group ">
    <button class="btn btn-primary" type="submit">{{ __('pages.Submit') }}</button>
</div>
@section('additional_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: transparent !important;
        color: #000 !important;
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
    $(document).ready(function() {
    $('.multiple-select').select2({
        dir:'rtl'
    });
    });
</script>
@endsection
