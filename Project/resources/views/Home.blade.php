@extends('layouts.bars')
@section('content')
<section style=" background-color: white">
  <div class="wow w3-container w3-center animate__fadeInLeftBig">
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div style="text-align-last: center" id="PAP1">
          <img src="/img/pro1.jpg " class="rowpic img-circle">
          <h4 class="title"><a href="">Lorem Ipsum</a></h4>
          <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
            occaecati cupiditate non provident</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div style="text-align-last: center" id="PAP2">
          <img src="/img/pro1.jpg" class="rowpic img-circle">
          <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
          <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div style="text-align-last: center" id="PAP3">
          <img src="/img/pro1.jpg" class="rowpic img-circle">
          <h4 class="title"><a href="">Magni Dolores</a></h4>
          <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
            mollit anim id est laborum</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div style="text-align-last: center" id="PAP4">
          <img src="/img/pro1.jpg" class="rowpic img-circle">
          <h4 class="title"><a href="">Nemo Enim</a></h4>
          <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
            voluptatum deleniti atque</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="CurvedAboutSection-div wow animate__fadeInLeftBig">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
    <path fill="#fff" fill-opacity="1" d="M0,96L1440,288L1440,0L0,0Z"></path>
  </svg>
  <div class="" style=" text-align: center">
    <div class="container-fluid row" id="C1">
      <div class="col-sm-4  my-auto">
        <h1 class="text-info" style=" font-family:verdana; "> About Our Products</h1>
      </div>
      <div class="col-sm-8  my-auto">
        <p class="text-info" class="lead " style="font-family:courier;">NE©O Chemicals is a leading company that deals
          with the cleaning of bank stained notes. We have the team of professionals who are well-versed with the
          knowledge of chemicals and know its appropriate usage. Our company is capable of removing stains from any kind
          of currency making it look new.
          GET LATEST CHEMICALS You can find a wide array of chemicals used in today’s modern world here. Not just the
          latest chemicals, we are also available with activating salts and humine powders. Just make us aware of your
          needs and requirements, we will do every thing to make it happen. You can expect the right solutions for every
          kind of tricky questions at NE©O.</p>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
    <path fill="#fff" fill-opacity="1" d="M0,224L1440,64L1440,320L0,320Z"></path>
  </svg>
</section>
@if($Product != '[]' )
<section class="wow animate__zoomIn" id="ProductSlider">
  <h1 style=" text-align: center; font-family:verdana;" id="ProductTitleSec"> Top Rated Product</h1>
  <div id="multi-item-example" class="container-fluid carousel slide carousel-multi-item " style="text-align: center"
    data-ride="carousel">
    <hr>
    <div class="carousel-inner shadow-xs p-3 xs-5 bg-white rounded" role="listbox">

      <div class="carousel-item active" style=""></div>

      @foreach ($Product as $item)
      <div class="carousel-item ">
        <div class="col-sm-4 ">
          <div class="card lg-2">
            <img class="card-img-top" src="/storage/img/{{$item->Picture}}" alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">{{$item->Name}}</h4>
              <p class="card-text ">{{ Str::limit($item->Details, 60) }}</p>
              <p><a class="btn btn-secondary" href="/Product/details/{{$item->id}}" role="button">View details
                  &raquo;</a></p>
              @if(!Auth::guest())
              <p>
                <button onclick="ADDChange('{{$item->id}}','addcart')" class="btn btn-outline-primary btn-lg ">AddCart
                  &raquo;</button>
              </p>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<br>
@endif
<section class="row wow animate__fadeInRightBig ">
  <div class="col-md-3 col-xs-6 text-center">
    <div class=" flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <h2>232</h2>
          <p>Clients</p>
        </div>
        <div class="flip-card-back" id="FP1">
          <h2>Architect & Engineer</h2>
          <p>We love that job</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-xs-6 text-center">
    <div class=" flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front" id="FSP2">
          <h2>521</h2>
          <p>Projects</p>
        </div>
        <div class="flip-card-back" id="FP2">
          <h2>
            <p>Architect & Engineer</p>
          </h2>
          <p>We love that job</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-xs-6 text-center">
    <div class=" flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front" id="FSP3">
          <h2>1,463</h2>
          <p>Hours Of Support</p>
        </div>
        <div class="flip-card-back" id="FP3">
          <h2>
            <p>Architect & Engineer</p>
          </h2>
          <p>We love that job</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-xs-6 text-center">
    <div class=" flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front" id="FSP4">
          <h2>15</h2>
          <p>Hard Workers</p>
        </div>
        <div class="flip-card-back" id="FP4">
          <h2>
            <p>Architect & Engineer</p>
          </h2>
          <p>We love that job</p>
        </div>
      </div>
    </div>
  </div>
</section>
<br>
<section class="CurvedMore-div wow animate__fadeInRightBig ">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
    <path fill="#fff" fill-opacity="1" d="M0,256L1440,96L1440,0L0,0Z"></path>
  </svg>
  <div class="float-right" style=" text-align: center">
    <div class="container-fluid row " id="1C">
      <div class="col-md-8  my-auto">
        <p class="text-dark" class="lead" style="font-family;">
          NE©O Chemicals is a leading company that deals with the cleaning of bank stained notes. We have the team of
          professionals who are well-versed with the knowledge of chemicals and know its appropriate usage. Our company
          is capable of removing stains from any kind of currency making it look new.
          GET LATEST CHEMICALS
          You can find a wide array of chemicals used in today’s modern world here. Not just the latest chemicals, we
          are also available with activating salts and humine powders. Just make us aware of your needs and
          requirements, we will do every thing to make it happen. You can expect the right solutions for every kind of
          tricky questions at NE©O.
        </p>
      </div>
      <div class="col-md-4 my-auto ">
        <h1 class="text-dark" style=" font-family:verdana; "> About Our Products</h1>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
    <path fill="#fff" fill-opacity="1" d="M0,64L1440,256L1440,320L0,320Z"></path>
  </svg>
</section>
<div id="mySlides" class="carousel slide" data-ride="carousel" data-interval="2000">
  <div class="carousel-inner">
    <div class="item active w3-container w3-center w3-animate-zoom">
      <h1>Animation is Fun!</h1>
      <p>The w3-animate-zoom class zooms in an element (from 0% to 100% in size).</p>
    </div>
    <div class="item w3-container w3-center w3-animate-zoom">
      <h1>Animation is Fun!</h1>
      <p>The w3-animate-zoom class zooms in an element (from 0% to 100% in size).</p>
    </div>
    <div class="item w3-container w3-center w3-animate-zoom">
      <h1>Animation is Fun!</h1>
      <p>The w3-animate-zoom class zooms in an element (from 0% to 100% in size).</p>
    </div>
  </div>
  <a class="left carousel-control" href="#mySlides" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#mySlides" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endsection