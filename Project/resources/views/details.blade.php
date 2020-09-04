@extends('layouts.bars')
@section('content')

<div class="container">

  <div class="card-body">
    <h2 class="card-title wow animate__fadeInDown" style="text-align-last:center">{{$Product->Name}}</h2>
    <hr />
  </div>
  <div class="row">
    <div class="col-md-5 order-1 order-md-2 wow animate__zoomIn">
      <img src="/storage/img/{{$Product->Picture}}" class="img-fluid rounded mx-auto d-block" alt=""><br>
    </div>
    <div class="col-md-7 pt-5 order-2 order-md-1 wow animate__fadeInLeftBig" style="text-align-last:center">
      <p class="font-italic">
        {{$Product->Details}}
      </p>
    </div>
  </div>
  <hr />
  <div class="container " style=" text-align: center">
    @if(!Auth::guest())
    @if(auth()->user()->admin == 1)
    <div class=" col-md-6" style="margin-bottom: 10px">
      <button onclick="Delete('{{$Product->id}}','DeleteProduct')" class="btn btn-outline-danger shadow btn-lg">Delete
      </button>
    </div>
    <div class="col-md-6" style="margin-bottom: 10px">
      <a href="/Product/edit/{{$Product->id}}" class="btn btn-outline-warning shadow btn-lg " role="button"
        aria-pressed="true">Update</a>
    </div>@endif
    <div class=" col-md-12" style="margin-bottom: 10px">
      <button onclick="ADDChange('{{$Product->id}}','addcart')" class="btn btn-outline-primary btn-lg ">AddCart
        &raquo;</button>
    </div>
    @endif
  </div>
</div>
<hr />
@endsection