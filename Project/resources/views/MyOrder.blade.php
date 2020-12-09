@extends('layouts.bars')
@section('content')
<section class="container" id='OrderList'>
    @if($Order != null )

    <h1 style=" text-align: center; font-family:verdana; background-color: rgb(1, 114, 243)">My Orders</h1>

    <table class="table wow animate__zoomIn table-hover">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
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
        <tr style="{{$ord->Done == 1 ? 'background-color:  rgb(134, 240, 187) ': ''}}">
          <td>{{$ord->id}}</td>
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
        @foreach ($Items as $item)
        @if($item[0]['Order_id'] == $ord->id)
        @foreach ($item as $it)
        <tr>
          <td>{{$it->Product_id}}</td>
          <td>{{$it->Quantity}}</td>
          <td>{{$it->Product_Price}}</td>
        </tr>
        @endforeach
        @endif
        @endforeach
        @endforeach
      </tbody>
    </table>
  
    <hr />


    @else
    <h1 class='wow animate__zoomIn ' style=" text-align: center; font-family:verdana;"> Your Order History is Empty</h1>
    @endif
</section>
<script>

</script>
@endsection