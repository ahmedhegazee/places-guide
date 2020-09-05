@if ($errors->any())
<div class="alert alert-danger mr-1 ml-1 pr-2">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        @if (session()->has('closed_time'))
        <li>{{ session()->get('closed_time') }}</li>
        @endif
    </ul>
</div>
@endif
