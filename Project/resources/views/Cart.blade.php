@extends('layouts.bars')
@section('content')
<section class="container" id='CartPage'>

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
                <div class="col-sm-3  my-auto">
                    <div class="input-group number-spinner">
                        <span class="input-group-btn">
                            <button class="btn btn-outline-primary shadow" data-dir="dwn"><span
                                    class="glyphicon glyphicon-minus"></span></button>
                        </span>
                        <input type="text" class="form-control text-center shadow" id="{{$CartItem['id']}}"
                            value="{{$CartItem['Quantity']}}" disabled>
                        <span class="input-group-btn">
                            <button class="btn btn-outline-primary shadow" data-dir="up"><span
                                    class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3  my-auto">

                    <button onclick="Delete('{{$CartItem['id']}}' , 'RemoveCart')"
                        class="btn btn-outline-danger shadow btn-md ">Delete From Cart</button>

                </div>
            </div>
        </div>
    </div>
    <hr />


    @endforeach

    <div class="card">
        <div class="card-body" style=" text-align: center">
            <div class="form-group ">
                <div class="col-md-12  my-auto" id="CartTotal1">
                    <h2><small> Sub Total: </small>{{$Cart->totalPrice}}</h2>
                    <a class="btn btn-outline-warning shadow btn-lg active" style="  white-space: normal;" href="/Order"
                        role="button">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <h1 class='wow animate__zoomIn ' style=" text-align: center; font-family:verdana;"> Your Cart Is Empty</h1>
    @endif
</section>
<script>

</script>
@endsection