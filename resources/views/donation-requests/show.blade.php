@extends('layouts.app')

@section('page_title')
Posts
@endsection


@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3>Donation Request</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Patient Name</b> <a class="float-right">{{$request->name}}</a>
                </li>
                <li class="list-group-item">
                    <b>Age</b> <a class="float-right">{{$request->age}}</a>
                </li>
                <li class="list-group-item">
                    <b>Blood Type</b> <a class="float-right">{{$request->bloodType->name}}</a>
                </li>
                <li class="list-group-item">
                    <b>No Blood Bags</b> <a class="float-right">{{$request->no_blood_bags}}</a>
                </li>
                <li class="list-group-item">
                    <b>Govern</b> <a class="float-right">{{$request->city->government->name}}</a>
                </li>
                <li class="list-group-item">
                    <b>City</b> <a class="float-right">{{$request->city->name}}</a>
                </li>
                <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{$request->phone}}</a>
                </li>
                <li class="list-group-item">
                    <b>Hospital Address</b> <a class="float-right">{{$request->address}}</a>
                </li>
            </ul>
            <p>{{$request->notes}}</p>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection