@extends('layouts.bars')
@section('content')
<section class="container  wow animate__zoomIn">
  <div class="row ">
    <div class="col-sm-12 " style=" text-align: center">
      <div class="col-sm-6">
        <div class="circle circle1 circle2">
          <a href="#"><img src="/img/order.png" alt="" height="100%" width="100%"></a>
        </div>
      </div>
      <div class="col-sm-6">

        <form action="{{route('MakeOrder')}}" class="contact-form" method="post">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" name="PhoneNumber" placeholder="PhoneNumber"
              value="{{$Order->PhoneNumber ?? ''}}">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="Address" placeholder="Address"
              value="{{$Order->Address ?? ''}}">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="City" placeholder="City" value="{{$Order->City ?? ''}}">
            </div>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" name="State" placeholder="State" value="{{$Order->State ?? ''}}">
            </div>
            <div class="form-group col-md-2">
              <input type="text" class="form-control" name="Zip" placeholder="Zip" value="{{$Order->Zip ?? ''}}">
            </div>
          </div>
          <br>
          <button class="btn btn-default btn-send"> <span class="glyphicon glyphicon-send"></span> Order </button>
      </div>
      </form>
    </div>
  </div>
  </div>
</section>
@endsection