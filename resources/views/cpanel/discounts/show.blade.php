@extends('layouts.app')
@section('page_title')
{{ __('pages.Discounts') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @include('flash::message')
    <!-- Default box -->
    <div class="card">

        <div class="card-body">
            <img src="{{ $discount->image }}" alt=""><br>
            @foreach ($langs as $lang)
                <span class="text-bold">{{ __('pages.Title').' ('.$lang.') : '}} </span>
                <span>{{  $discount->title[$lang] }}</span><br>
            @endforeach
            <span class="text-bold">{{ __('pages.Discount').' : '}} </span>
            <span>{{  $discount->discount}}</span><br>
            <span class="text-bold">{{ __('pages.Start Date Discount').' : '}} </span>
            <span>{{  $discount->starting_date}}</span><br>
            <span class="text-bold">{{ __('pages.End Date Discount').' : '}} </span>
            <span>{{  $discount->end_date}}</span>
            @foreach($langs as $lang)
                <br>
                <span class="text-bold">{{ __('pages.Discount About').' ('.$lang.') : '}} </span>
                <pre>{{ $discount->content[$lang] }}</pre>
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
