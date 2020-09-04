@extends('layouts.bars')
@section('content')

<section class="container  wow animate__zoomIn">
  <div class="row ">
    <div class="col-sm-12 " style=" text-align: center">
      <div class="col-sm-6">
        <div class="circle circle1 circle2">
          <a href="#"><img src="/img/gmail.png" alt=""></a>
        </div>
      </div>
      <div class="col-sm-6 ">
        <h2><strong>Contact Us</strong></h2>
        <form method='POST' action="/contactUs" class="contact-form">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" name="Title" placeholder="Subject" required="">
          </div>
          <div class="form-group">
            <textarea class="form-control textarea-contact" rows="5" name="Body"
              placeholder="Type Your Message/Feedback here..." required=""></textarea>
            <br>
            <button type="submit" class="btn btn-default btn-send"> <span class="glyphicon glyphicon-send"></span> Send
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="CurvedMore-div  wow animate__zoomIn ">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
    <path fill="#fff" fill-opacity="1"
      d="M0,160L48,144C96,128,192,96,288,96C384,96,480,128,576,144C672,160,768,160,864,149.3C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
    </path>
  </svg>

  <div id="mySlides" class="carousel slide text-center text-info" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
      <div class="item active w3-container w3-center w3-animate-zoom">
        <h1>Follow Us On Social Media</h1>
        <p>The w3-animate-zoom class zooms in an element (from 0% to 100% in size).</p>
      </div>

      <div class="item w3-container w3-center w3-animate-zoom">
        <h1>Text Slider!</h1>
        <p>The w3-animate-zoom class zooms in an element (from 0% to 100% in size).</p>
      </div>
    </div>
  </div>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
    <path fill="#fff" fill-opacity="1"
      d="M0,160L48,144C96,128,192,96,288,96C384,96,480,128,576,144C672,160,768,160,864,149.3C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
    </path>
  </svg>
</section>

<div class="container-fluid circleMar  wow animate__zoomIn" style=" text-align: center">
  <section class="row">
    <div class="col-md SocialCircle">
      <div class="circle circle1">
        <a href="#"><img src="img/facebook.png" alt=""></a>
      </div>
    </div>
    <div class="col-md SocialCircle">
      <div class="circle circle1">
        <img src="img/instagram.png" alt="">
      </div>
    </div>
    <div class="col-md SocialCircle">
      <div class="circle circle1">
        <a href="#"><img src="img/twitter.png" alt=""></a>
      </div>
    </div>
    <div class="col-md SocialCircle">
      <div class="circle circle1">
        <a href="#"><img src="img/linkedin.png" alt=""></a>
      </div>
    </div>
    <div class="col-md SocialCircle">
      <div class="circle circle1">
        <a data-toggle="modal" data-target="#modalRegular"><img src="img/place.png" alt=""></a>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="modalRegular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body mb-0 p-0">
        <div class="z-depth-1-half map-container-9" style="height: 400px">
          <iframe src="https://maps.google.com/maps?q=new%20delphi&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection