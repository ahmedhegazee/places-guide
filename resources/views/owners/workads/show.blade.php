@extends('owners.app')
@section('page_title')
{{ __('pages.Work Ads') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @include('flash::message')
    <!-- Default box -->
    <div class="card">

        <div class="card-body">
            @foreach ($langs as $lang)
                <span class="text-bold">{{ __('pages.Title').' ('.$lang.') : '}} </span>
                <span>{{  $work_ad->title[$lang] }}</span><br>
            @endforeach

            <span class="text-bold">{{ __('pages.Quantity').' : '}} </span>
            <span>{{  $work_ad->quantity}}</span><br>
            <span class="text-bold">{{ __('pages.Workers Categories').' : '}} </span>
            <span>{{  $work_ad->workerCategory->name}}</span>
                @foreach($langs as $lang)
                <br>
            <span class="text-bold">{{ __('pages.Ad About').' ('.$lang.') : '}} </span>
            <pre>{{ $work_ad->content[$lang] }}</pre>
                @endforeach
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    @csrf
</section>
<!-- /.content -->
@endsection
@section('additional_styles')
<style>
    pre {
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "HelveticaNeue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        padding: 0 !important;
    }
</style>
@endsection
