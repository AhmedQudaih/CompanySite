<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Cart;
use App\Items;
use Carbon\Carbon;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AddCart()
    {    if(request()->ajax()) 
        {
        $ID =  $_POST['ID'];
        $Product = Product::find($ID);
        if($Product->Quantity !=0){
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = new Cart();
            
            }  
        
        $cart->AddToCart($Product);
        session()->put('cart', $cart);
        return response()->json(['Product Added Successfully']);
        }else return response()->json(['Product Sold Out']);
      }   
    }

    public function RemoveCart()
    {    if(request()->ajax()) 
        {
        $ID =  $_POST['ID'];

        $cart = new Cart(session()->get('cart'));
        $cart->remove($ID);
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }    
        } return response()->json(['Product Removed Successfully']);

    }


    public function Cart()
    {
            
        if (session()->has('cart')) {
            $Cart = new Cart(session()->get('cart'));
        } else {
            $Cart = null;
        }
        return view('Cart')->with('Cart' , $Cart);

    }



    public function ProductCart()
    {
        if(request()->ajax()) 
        {
        $ID =  $_GET['ID'];
        $Val =  $_GET['Val'];
        $cart = new Cart(session()->get('cart'));
        $cart->Quantity($ID, $Val);
        session()->put('cart', $cart);

        }return response()->json(['Quantity Changed Successfully']);

    }
    

}
