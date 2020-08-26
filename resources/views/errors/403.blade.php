@extends('errors.layout')

@section('code', '403')
@section('short-message', 'Forbidden')
@section('long-message')
Sorry, you are forbidden from accessing this page.
Meanwhile, you may <a href="{{route('client.index')}}">return to dashboard</a> .
@endsection
@section('page_title')
403 Error Page
@endsection
