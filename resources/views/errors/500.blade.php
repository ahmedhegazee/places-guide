@extends('errors.layout')

@section('code', '500')
@section('short-message', 'Not Found')
@section('long-message')
Something heppend
Meanwhile, you may <a href="{{route('client.index')}}">return to dashboard</a> .
@endsection
@section('page_title')
500 Error Page
@endsection
