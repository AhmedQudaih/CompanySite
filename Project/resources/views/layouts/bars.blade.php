<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <link rel="icon" href="https://mdbootstrap.com/img/logo/mdb-transparent.png" type="image/icon type">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <script src="/js/wow.min.js"></script>
  <script>
    new WOW().init();  
  </script>

</head>

<body>
  <section class="wow curved-div w3-center w3-animate-top">
    <div style="text-align: center;">
      <img class="navlogo" src="https://mdbootstrap.com/img/logo/mdb-transparent.png" alt="mdb logo"
        style="margin-top: 20px;">
    </div>

    <nav class="navbar navbar-expand-md navbar-light topnav-center topnav">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item active">
            <a class="nav-link" data-url='/' href="/">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="/Products">Products </a>
            <div class="dropdown-content" id="CategoryNav">
              @foreach ($Category as $item)
              <a href="/Products/{{$item->id}}">{{$item->Name}}</a>
              @endforeach
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-url='/Company' href="/Company">Company</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-url='/contactUs' href="/contactUs">Contact Us</a>
          </li>
          @if(!Auth::guest())
          <li class="nav-item">
            <a class="nav-link" href="/Cart">Cart</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/Order">Make Order</a>
          </li>
          @if(auth()->user()->admin == 1)
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#AddProductModal">Add Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#AddCategoryModal">Add Category</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="/AdminList">AdminList </a>
            <div class="dropdown-content">
              <a class="dropdown-item" href="/AdminList#AllProducts">Products</a>
              <a class="dropdown-item" href="/AdminList#AllUsers">Users</a>
              <a class="dropdown-item" href="/AdminList#AllOrders">Orders</a>
            </div>
          </li>
          @endif
          @endif
          <li class="nav-item">
            @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          @endif
          @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} </span>
            </a>

            <div class="dropdown-menu dropdown-content dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a class="dropdown-item" href="/AdminList/EditUser/{{ Auth::user()->id }}">Update User</a>
              <a class="dropdown-item" href="/Order/MyOrder">My Orders</a>
            </div>
          </li>
      </div>
      @endguest
      </ul>
      </div>
    </nav>
    <div id="mySlides" class="carousel slide text-center" data-ride="carousel" data-interval="3000">
      <div class="carousel-inner">
        <div class="item active w3-container w3-center w3-animate-zoom">
          <h1>Welcome {{  Auth::user()->name?? ''}} in our Website</h1>
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
  @include('sweetalert::alert')
  @yield('content')


  <!-- Footer -->

  <footer class="curved-div wow w3-animate-bottom">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
      <path fill="#fff" fill-opacity="1"
        d="M0,160L48,144C96,128,192,96,288,96C384,96,480,128,576,144C672,160,768,160,864,149.3C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
      </path>
    </svg>
    <div class="row text-center">
      <div class="col-md-4">
        <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" style="width:20%;margin-top: 20px;">
        <hr class="light">
        <p>02 12121212</p>
        <p>www.MBD.edu.eg</p>
        <p>Software Engineering</p>
        <p>Cairo, Egypt</p>
      </div>
      <div class="col-md-4">
        <hr class="light">
        <h5>Work Time</h5>
        <hr class="light">
        <p>Sunday: 9am - 4pm</p>
        <p>Monday: 9am - 6pm</p>
        <p>Tuesday: 9am - 4pm</p>
        <p>Thursday: 10am - 3pm</p>
      </div>
      <div class="col-md-4" id="CategoryFoo">
        <hr class="light">
        <h5>Our Categouries</h5>
        <hr class="light">
        @foreach ($Category as $item)
        <p>{{$item->Name}}</p>
        @endforeach
      </div>
      <div class="col-12">
        <hr class="light">
        <h5>&copy; MDB.com</h5>
        <small> Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a>
          from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></small>
      </div>
    </div>
  </footer>



  <div class="modal fade" id="AddCategoryModal" tabindex="-1" role="dialog" aria-labelledby="AddCategoryModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="AddCategoryModalTitle">Add Category</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row ">
            <div class="col-sm-12 " style=" text-align: center">
              <form id='AddCategory' method="POST" data-route="{{route('AddCategory')}}" class="contact-form">
                @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <input type="text" class="form-control" id="Name" name="Name" placeholder="Add Category" autofocus="">
                </div>
                <button type="submit" class="btn btn-outline-info btn-md shadow postforms">Add Category</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>





  <div class="modal fade" id="AddProductModal" tabindex="-1" role="dialog" aria-labelledby="AddProductModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="AddProductModalTitle">Add Product</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-sm-12" style=" text-align: center">
            <form id='AddProduct' method="POST" action="{{route('AddProduct')}}" class="contact-form"
              enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <div class="custom-file form-group">
                <input type="file" class="custom-file-input" name='pic' id="pic">
                <label class="custom-file-label" for="pic">Choose file</label>
              </div>
              <div class="form-group" id="CategoryPro">
                <select class="form-control" name="Category">
                  @foreach ($Category as $item)
                  <option value="{{$item->id}}">{{$item->Name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Name" required=""
                  autofocus="">
              </div>
              <div class="form-group form_left">
                <input type="Price" class="form-control" id="Price" name="Price" placeholder="Price">
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="Quantity" name="Quantity" placeholder="Quantity"
                  required="">
              </div>
              <div class="form-group">
                <textarea class="form-control textarea-contact" rows="5" id="Details" name="Details"
                  placeholder="Enter Your Product Details here..." required=""></textarea>
                <br>
                <button type="submit" class="btn btn-outline-info shadow btn-send postforms"> <span
                    class="glyphicon glyphicon-plus"></span> Add Product </button>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  @include('sweetalert::alert')
</body>
<script>
  $('#CateFilter').change(function() {
        var id = $('#CateFilter').val();
        if(id != 0){
        $(document.body).load('/Products/'+ id);
        }else location.reload();
        })


 $(document).delegate('form', 'submit', function(event) {
    var form_data = $(this);
    var id = form_data.attr('id');
  if( id == 'AddCategory' || id =='EditCategory' ){
    var route = form_data.data('route');
    console.log(id);
    $.ajax({
        type:  form_data.attr('method'),
        url: route,
        data: form_data.serialize(),
        success: function (response) {
          alert(response);
          $('#AdminTable').load( '/AdminList '  +  ' #AdminTable');
          $('#CategoryEdit').load( '/AdminList'  +  ' #CategoryEdit');
          $('#CategoryFoo').load( '/ '  +  ' #CategoryFoo');
          $('#CategoryPro').load( '/ '  +  ' #CategoryPro');
          $('#CategoryNav').load( '/ '  +  ' #CategoryNav');
        }
    });
    event.preventDefault();}
});




function Delete($id, $fun) {
  switch($fun) {
  case "DeleteCategory":
    var route = '{{route('DeleteCategory')}}';
    break;
  case "DeleteProduct":
    var route = '{{route('DeleteProduct')}}';
    break;
  case "RemoveUser":
    var route = '{{route('RemoveUser')}}';
    break;
  case "RemoveCart":
  var route = '{{route('RemoveCart')}}';
  break;
 }
      $.ajax({
          url: route,
          type: "POST",
          data: { ID: $id , _method: "DELETE" , _token: "{{ csrf_token() }}" },
          success: function(response){
            alert(response);
          $('#AdminTable').load( '/AdminList '  +  ' #AdminTable');
          $('#CategoryEdit').load( '/AdminList'  +  ' #CategoryEdit');
          $('#CategoryFoo').load( '/ '  +  ' #CategoryFoo');
          $('#CategoryPro').load( '/ '  +  ' #CategoryPro');
          $('#CategoryNav').load( '/ '  +  ' #CategoryNav');
          $('#CartPage').load( '/Cart '  +  ' #CartPage');
          $('#ProductSlider').load( '/ '  +  '#ProductSlider');
          }
      });
      };




function ADDChange($id, $fun) {
  switch($fun) {
  case "admin":
    var route = '{{route('MakeAdmin')}}';
    break;
    case "OrderDone":
    var route = '{{route('OrderDone')}}';
    break;
  case "addcart":
    var route = '{{route('AddCart')}}';
    break;
  case "SubOrder":
    var route = '{{route('SubOrder')}}';
  break;

}
  $.ajax({
      url: route,
      type: "POST",
      data: { ID: $id , _method: "POST" , _token: "{{ csrf_token() }}" },
      success: function(response){
        alert(response);
        $('#CartPage').load( '/Cart '  +  ' #CartPage');
        $('#AdminTable').load( '/AdminList '  +  ' #AdminTable');
      } 
  });
};

    $(document).on('click', '.number-spinner button', function () {   
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.number-spinner').find('input').val(newVal);
  var ID = btn.closest('.number-spinner').find('input').attr('id');
  $.ajax({
                url: '{{ route('ProductCart') }}',
                type: 'GET',
                data: { ID: ID , Val: newVal },
                success: function (response) {
                alert(response);
                $('#CartTotal1').load( '/Cart '  +  ' #CartTotal1');
                $('#CartTotal2').load( '/Order '  +  ' #CartTotal2');
        
        }
   }); 

});

/*
  $(function(){
    $("#AddProduct").submit(function(e){
    var route = $("#AddProduct").data('route');
    var form_data = $(this);
    $.ajax({
        type:  form_data.attr('method'),
        url: route,
        data: form_data.serialize(),
        success: function (response) {
          alert(response);
          $('#AdminTable').load( '/AdminList '  +  ' #AdminTable');
          $('#CategoryFoo').load( '/ '  +  ' #CategoryFoo');
          $('#CategoryPro').load( '/ '  +  ' #CategoryPro');
        }
    });
    e.preventDefault();
  });
 });
*/

$('.carousel .carousel-item').each(function(){
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
    next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
    
    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
        	next = $(this).siblings(':first');
      	}
        
        next.children(':first-child').clone().appendTo($(this));
      }
});

 
</script>

</html>