@extends('layouts.bars')
@section('content')

<section class="container  wow animate__zoomIn">
  <div class="row ">
    <div class="col-sm-12 " style=" text-align: center">
      <div class="col-sm-6">
        <div class="circle circle1 circle2">
          <a><img src="/img/order.png" alt="" height="100%" width="100%"></a>
        </div>
      </div>
      <div class="col-sm-6">
        <form method="POST" action="{{route('UpdateProduct' , $Product->id )}}" class="contact-form"
          enctype="multipart/form-data">
          @csrf

          <div class="custom-file form-group">
            <input type="file" class="custom-file-input" name="pic" id="pic">
            <label class="custom-file-label" for="pic">Choose file</label>
          </div>
          <div class="form-group">
            <select class="form-control" name="Category">
              <option value="{{$Product->CategoryId}}">Choose Category</option>
              @foreach ($Category as $item)
              <option value="{{$item->id}}">{{$item->Name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="Name" name="Name" value="{{$Product->Name}}" required=""
              autofocus="">
          </div>
          <div class="form-group form_left">
            <input type="Price" class="form-control" id="Price" name="Price" value="{{$Product->Price}}">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="Quantity" name="Quantity" value="{{$Product->Quantity}}"
              required="">
          </div>
          <div class="form-group">
            <textarea class="form-control textarea-contact" rows="5" id="Details" name="Details"
              required="">{{$Product->Details}}</textarea>
            <br>
            <button class="btn btn-default btn-send"> <span class="glyphicon glyphicon-edit"></span> Edit Product
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection