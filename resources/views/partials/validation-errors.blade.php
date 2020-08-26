@if ($errors->any())
<div class="alert alert-danger mr-1 ml-1 pr-2">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
