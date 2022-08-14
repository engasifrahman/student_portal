@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('main_content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-6 col-md-3 grid-margin">
      <div class="card text-center p-4">
        <div class="card-body">
          <h2 class="card-title text-info"><i class="fa fa-university"></i> Total Faculty</h2>
        </div>
        <div class="text-success h4">{{ $faculty }}</div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 grid-margin">
      <div class="card text-center p-4">
        <div class="card-body">
          <h2 class="card-title text-info"><i class="fa fa-building-o"></i> Total Department</h2>
        </div>
        <div class="text-success h4">{{ $dept }}</div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 grid-margin">
      <div class="card text-center p-4">
        <div class="card-body">
          <h2 class="card-title text-info"><i class="fa fa-graduation-cap"></i>  Total Sutudent</h2>
        </div>
        <div class="text-success h4">
          {{ $student }}</div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 grid-margin">
      <div class="card text-center p-4">
        <div class="card-body">
          <h2 class="card-title text-info"><i class="fa fa-users"></i> Total Faculty Member</h2>
        </div>
        <div class="text-success h4">{{ $fm }}</div>
      </div>
    </div>

    <div class="col-md-12">
      <img src="{{ asset('bannerPic/1.png') }}" width="100%" alt="banner1">
      <img src="{{ asset('bannerPic/2.jpg') }}" width="100%" alt="banner2">
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
@endsection