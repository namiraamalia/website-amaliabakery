@extends('layouts.back', ['web' => $web])
@section('title', 'Dashboard')
@section('container')
<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon" style="background-color: #444444">
          <i class="fas fa-box"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Product</h4>
          </div>
          <div class="card-body">
            {{ $product }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-th-large"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Category</h4>
          </div>
          <div class="card-body">
            {{ $category }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection