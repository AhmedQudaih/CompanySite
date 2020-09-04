@extends('layouts.bars')
@section('content')
<section class="container-fluid " id="ProductPage">

  @if($Product != '[]')
  <h1 class="wow animate__zoomIn" style=" text-align: center; font-family:verdana;"> Our Products</h1>
  <div class="form-group wow animate__zoomIn">
    <select id='CateFilter' class="form-control" name="Category">
      <option hidden="">Filter By Category</option>
      <option value="0">All Products</option>
      @foreach ($Category as $item)
      <option value="{{$item->id}}">{{$item->Name}}</option>
      @endforeach
    </select>
  </div>
  <hr style="margin-top: 5px;">
  <div id="fil">
    @foreach ($Product as $item)
    <div class="col-sm-4 wow animate__zoomIn " id="{{$item->CategoryId}}">
      <div class="card lg-2">
        <img class="card-img-top" src="/storage/img/{{$item->Picture}}" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">{{$item->Name}}</h4>
          <p class="card-text ">{{ Str::limit($item->Details, 60) }}</p>
          <p><a class="btn btn-secondary" href="/Product/details/{{$item->id}}" role="button">View details &raquo;</a>
          </p>
          <p>
            <button onclick="ADDChange('{{$item->id}}','addcart')" class="btn btn-outline-primary btn-lg ">AddCart
              &raquo;</button>
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
<h1 class='wow animate__zoomIn ' style=" text-align: center; font-family:verdana;"> There are No any Products yet</h1>
@endif
</section>


@endsection