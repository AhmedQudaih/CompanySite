@extends('layouts.bars')
@section('content')
<section class="container table-responsive  col-12" id="AdminTable">
  <h1 style=" text-align: center; font-family:verdana; background-color: rgb(1, 114, 243)">Products</h1>
  <table class="table  wow animate__zoomIn table-hover" >
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($Category as $category)
      <tr class="active">
        <td>{{$category->Name}}</td>
        <td>
          <button onclick="Delete('{{$category->id}}','DeleteCategory')"
            class="btn btn-outline-danger shadow">Delete</button>

        </td>
        <td>
          <button data-toggle="modal" data-target="#EditCategoryModal" class="btn btn-outline-primary shadow">Edit
            Category </button>

        </td>
      </tr>
      @foreach ($Product as $item)
      @if($item->CategoryId == $category->id)
      <tr>
        <th scope="row">{{$item->id}}</th>
        <td>{{$item->Name}}</td>
        <td>{{$item->Price}}</td>
        <td>{{$item->Quantity}}</td>

        <td><a href="/Product/edit/{{$item->id}}" class="btn btn-outline-primary shadow " role="button"
            aria-pressed="true">Update</a></td>
        <td>
          <button onclick="Delete('{{$item->id}}','DeleteProduct')" class="btn btn-outline-danger shadow">Delete
          </button>

        </td>
      </tr>
      @endif
      @endforeach
      @endforeach
    </tbody>
  </table>

  <h1 style=" text-align: center; font-family:verdana; background-color: rgb(1, 114, 243)"> Users</h1>

  <table class="table wow animate__zoomIn table-hover">
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">User Name</th>
        <th scope="col">Email</th>
        <th scope="col">Remove User</th>
        <th scope="col">Make Admin</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($User as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>
          <button onclick="Delete('{{$user->id}}','RemoveUser')" class="btn btn-outline-danger shadow">Remove </button>
        </td>
        <td>
          <input class="form-check-input" onclick="ADDChange('{{$user->id}}','admin')" type="checkbox" name="admin"
            id="admin" value="1" {{$user->admin == 1 ? 'checked' : ''}} {{$user->id == auth()->user()->id ? 'disabled ' : ''}} >
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h1 style=" text-align: center; font-family:verdana; background-color: rgb(1, 114, 243)"> Orders</h1>

  <table class="table wow animate__zoomIn table-hover">
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">User Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Address</th>
        <th scope="col">City</th>
        <th scope="col">Status</th>
        <th scope="col">Zip</th>
        <th scope="col">Totla</th>
        <th scope="col">Payment Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($Order as $ord)
      <tr>
        <td>{{$ord->id}}</td>
        <td>{{$User->where('id', $ord->User_id)->first()->name}}</td>
        <td>{{$ord->PhoneNumber}}</td>
        <td>{{$ord->Address}} </td>
        <td>{{$ord->City}}</td>
        <td>{{$ord->State}}</td>
        <td>{{$ord->Zip}}</td>
        <td>{{$ord->Total}}</td>
        <td>
          @if($ord->PayStatus == 1)
          <p>Cridte</p>
          @else
          <p>Cash</p>
          @endif
        </td>
      </tr>
      <tr class="active">
        <th scope="col">Products</th>
        <th scope="col">Qunatity</th>
        <th scope="col">Price</th>
      </tr>
      @foreach ($Items->where('Order_id', $ord->id) as $it)
      <tr>
        <td>{{$Product->where('id', $it->Product_id)->first()->Name}}</td>
        <td>{{$it->Quantity}}</td>
        <td>{{$it->Product_Price}}</td>
      </tr>
      @endforeach
      @endforeach
    </tbody>
  </table>
  
</section>

<div class="modal fade" id="EditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="EditCategoryModalTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h2 class="modal-title" id="EditCategoryModalTitle">Edit Category</h2>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" >
      <div class="row " style=" text-align: center">
        <form id='EditCategory' method="POST" data-route="{{route('EditCategory')}}" class="contact-form">
          @csrf
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      
          <div class=" col-xs-6">
            <div class="form-group " id="CategoryEdit">
              <select class="form-control" name="Categoryid">
                @foreach ($Category as $cat)
                <option value="{{$cat->id}}">{{$cat->Name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter the new Name"
              autofocus="" required>
          </div>
     
          <div class=" col-xs-12" style="margin-top: 10px ">
            <button type="submit" class="btn btn-outline-info btn-md shadow ">Edit Category</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</div>



@endsection