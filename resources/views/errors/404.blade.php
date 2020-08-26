@extends('errors.layout')

@section('code', '404')
@section('short-message', 'Not Found')
@section('long-message')
We could not find the page you were looking for.
Meanwhile, you may <a href="{{route('client.index')}}">return to dashboard</a> .
@endsection
@section('page_title')
404 Error Page
@endsection
