<div class="form-group">
    <label for="name"> Name</label>
    {!!Form::text('name',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="display_name"> Display Name</label>
    {!!Form::text('display_name',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="description">Description</label>
    {!!Form::textarea('description',null,[
    'class'=>'form-control'
    ])!!}
</div>

<div class="form-group ">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
