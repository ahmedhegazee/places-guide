@extends('layouts.app')
@inject('client', 'App\Models\Client')
@inject('request', 'App\Models\DonationRequest')
@inject('post', 'App\Models\Post')
@section('page_title')
    Dashboard
@endsection
@section('content')
        <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
              <span class="info-box-number">{{$client->count()}}</span>
              </div>
        </div>
        </div>
                <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Donation Requests</span>
              <span class="info-box-number">{{$request->count()}}</span>
              </div>
        </div>
        </div>
                        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-images"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Posts</span>
              <span class="info-box-number">{{$post->count()}}</span>
              </div>
        </div>
        </div>
    </div>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
                    You are logged in!
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

