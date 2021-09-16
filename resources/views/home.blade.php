@extends('layouts.master')
@section('content')
<!--================Hero Banner Area Start =================-->
<section class="hero-banner magic-ball">
    <div class="container">

      <div class="row align-items-center text-center text-md-left">
        <div class="col-md-6 col-lg-5 mb-5 mb-md-0">
          <h1>Rescue Tracker</h1>
          <p>Rescue Tracker adalah aplikasi berbasis website untuk mempermudah pencarian pendaki yang hilang, wbsite ini di buat oleh kerjasama Dosen ITTP dengan mahasiswa. </p>
          <a class="button button-hero mt-4" href="/login">Get Started</a>
        </div>
        <div class="col-md-6 col-lg-7 col-xl-6 offset-xl-1">
          <img class="img-fluid" src="{{asset('assets/img/home/maps.png')}}" alt="">
        </div>
      </div>
    </div>
  </section>
  <!--================Hero Banner Area End =================-->
@endsection