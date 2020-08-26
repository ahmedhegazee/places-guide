@inject('perm','App\Models\Permission')
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
<div class="form-group">
    <label for="permissions">Permissions</label>
    <div class="row mb-2">
        <div class="col-3-sm mr-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" id="selectAll" value="">
                    </div>
                </div>
                <input type="text" class="form-control" value="Select All" disabled>
            </div>
        </div>
    </div>
    @foreach ($perm->all()->groupBy('permissions_group')->keys() as $group)
    {{-- <h4>{{$group}}</h4> --}}
    <div class="row mb-2 p-1" style="border: 1px solid #ccc; border-radius:10px;">
        {{-- <div class="col-2 mr-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" id="select-all-{{$group}}" onclick="selectAll('{{$group}}')" value="">
    </div>
</div>
<input type="text" class="form-control" value="Select All" disabled>
</div>
</div> --}}

@foreach ($perm->all()->groupBy('permissions_group')->get($group) as $permission)
<div class="col-3-sm mr-1">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" name="permissions_list[]" {{-- class="select-all-{{$group}}"
                    onclick="check('{{$group}}')" --}} value="{{$permission->id}}"
                    @if($model->hasPermission($permission->name))
                checked
                @endif

                >
            </div>
        </div>
        <input type="text" class="form-control" value="{{$permission->display_name}}" disabled>
    </div>
</div>
@endforeach

</div>
@endforeach
</div>
<div class="form-group ">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
@section('additional_scripts')
<script>
    // function selectAll(group){
    //     $('.select-all-'+group).prop("checked", $('#select-all-'+group).prop("checked"));
    // }
    // function check(group){

    //     if (!$('.select-all-'+group).prop("checked")) {
    //     $('#select-all-'+group).prop("checked", false);
    //     }
    // }
$("#selectAll").click(function() {
$("input[type=checkbox]").prop("checked", $(this).prop("checked"));
});

$("input[type=checkbox]").click(function() {
if (!$(this).prop("checked")) {
$("#selectAll").prop("checked", false);
}
});

    // $("input[type=checkbox]").click(function() {
    // if (!$(this).prop("checked")) {
    // $("#selectAll").prop("checked", false);
    // }
    // });
</script>
@endsection
