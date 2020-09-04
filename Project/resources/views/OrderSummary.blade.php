@extends('layouts.bars')
@section('content')
<section class="container  wow animate__zoomIn">

  <div class="row ">
    <div class="col-sm-12 " style=" text-align: center">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-12  my-auto">
                <h2>{{Auth::user()->name}}</h3>
              </div>
              <div class="col-sm-12  my-auto">
                <p class="card-text">
                  <h3>{{$Order->Address}}</h3>
                </p>
                <small>{{$Order->City}} - {{$Order->State}} - {{$Order->Zip}}</small>
              </div>
              <div class="col-sm-12  my-auto">
                <div class="input-group number-spinner">
                  {{$Order->PhoneNumber}}
                </div>
              </div>
              <div class="col-sm-12  my-auto">
                <p><a class="btn btn-outline-danger" href="/Order/UpdateOrder" role="button">Update Data &raquo;</a></p>
              </div>
            </div>
          </div>
        </div>

        <div class="card" style="  margin-top: 30px">
          <div class="card-header">
            How would you like to pay<strong> {{$Cart->totalPrice}}</strong>
          </div>
          <div class="card-body">
            <div class="col-md-12 form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="PayOption" value="Credit" checked><strong>Credit or Debit Cards</strong>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="Credit box wow animate__zoomIn" style="margin: 50px;">

          <form action="/charge" method="post" id="payment-form">
            <div class="shadow">
              @csrf
              <input type="hidden" name="amount" value="{{$Cart->totalPrice}}">
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors. -->
              <div id="card-errors" role="alert"></div>
            </div>

            <button class="btn btn-outline-primary shadow btn-lg " style="margin-top: 20px">Submit Payment</button>


          </form>
        </div>


        <div class="card" style=" margin-bottom: 30px">
          <div class="card-body">
            <div class="col-md-12 form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="PayOption" value="Cash"><strong>Cash on delivery (COD)</strong>
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="card" style=" margin-top: 30px; margin-bottom: 30px">
          <div class="card-body" style=" text-align: center">
            <div class="form-group ">
              <div class="col-md-12  my-auto" id="CartTotal2">
                <h2><small> Sub Total: </small>{{$Cart->totalPrice}}</h2>
                <a class="btn btn-outline-primary shadow btn-lg active" onclick="ADDChange('','SubOrder')"
                  style="  white-space: normal;" href="/" role="button" disabled>Submit Payment And Check Out</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        @if($Cart != null )
        @foreach ($Cart->items as $CartItem)
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-3  my-auto">
                <img class="card-img-top" src="/storage/img/{{$CartItem['Picture']}}" alt="Card image cap"
                  style="max-height: 150px; ">
              </div>
              <div class="col-sm-3  my-auto">
                <p class="card-text"> Product Name: {{$CartItem['Name']}} </p>
              </div>
              <div class="col-sm-4  my-auto">
                <div class="input-group number-spinner">
                  <span class="input-group-btn">
                    <button class="btn btn-outline-primary shadow" data-dir="dwn"><span
                        class="glyphicon glyphicon-minus"></span></button>
                  </span>
                  <input type="text" class="form-control text-center shadow" id="{{$CartItem['id']}}"
                    value="{{$CartItem['Quantity']}}">
                  <span class="input-group-btn">
                    <button class="btn btn-outline-primary shadow" data-dir="up"><span
                        class="glyphicon glyphicon-plus"></span></button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr />
        @endforeach

        @else
        <h1>Your Cart Is Empty</h1>
        @endif
      </div>
    </div>
  </div>
  </div>
</section>
<script>
  $(document).ready(function(){
      $('input[type="radio"]').click(function(){
          var inputValue = $(this).attr("value");
          var targetBox = $("." + inputValue);
          $(".box").not(targetBox).hide();
          $(targetBox).show();
      });
  });

window.onload = function(){
  // Create a Stripe client.
var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}}
</script>
@endsection