<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use RealRashid\SweetAlert\Facades\Alert;


use App\Product;
use App\Items;
use App\Cart;
use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function Order()
    {    if(session()->has('cart') )
        {
           
            $items = $this->ProQuantityValidation();
            if($items != null)
            {
                alert()->error('Quantity Error',json_encode($items));
               return redirect()->back();
                                   
            }
            $Order = Order::where('User_id' , auth()->user()->id)->orderBy('id', 'DESC')->first();
            
            if($Order != null){       

            $Cart = new Cart(session()->get('cart'));
            session()->put('Order', $Order);
            return view('/OrderSummary')->with('Order',$Order)->with('Cart' , $Cart);

            }else{

                return view('Order');
            }

        }else return redirect('/');
          
    }
   
    public function MakeOrder(Request $request)
    {    
         if(session()->has('cart'))
        {
         $this->validate($request,[
        'PhoneNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
        'Address' => 'required|max:255',
        'City'=> 'required|string|max:50',
        'State'=> 'required|string|max:50',
        'Zip'=> 'required|max:15'
        ]);
     
       $Order = new Order;
       $Order->User_id = auth()->user()->id;
       $Order->PhoneNumber = $request->input('PhoneNumber');
       $Order->Address = $request->input('Address');
       $Order->City = $request->input('City');
       $Order->State = $request->input('State');
       $Order->Zip = $request->input('Zip');
       $Order->Total = 0;    
       session()->forget('Order');  
       session()->put('Order', $Order);
       $Cart = new Cart(session()->get('cart'));
       return view('/OrderSummary')->with('Order',$Order)->with('Cart' , $Cart);
        
    }
         return redirect('/');          
    }

    public function editOrder()
    {    
        return view('Order');
    }

    public function MyOrder(){
      
        $i=0;
       $Order = Order::where('User_id' , auth()->user()->id)->get();
        foreach ($Order as $order){
            $Items[$i] = Items::where('Order_id' , $order->id)->get();
            $i++;
        };
        foreach ($Items as $Item){
            $i=0;
            foreach ($Item as $ite){
            $temp = Product::where('id' , $ite['Product_id'])->get();
            $Item[$i]['Product_id'] =  $temp[0]['Name'];
            $i++;
        }
        };

      
         return view('/MyOrder')->with('Order',$Order)->with('Items' , $Items);
        }
    
    public function OrderDone(Request $request){
        if(auth()->user()->admin == 1 && request()->ajax() ){ 
            $ID =  $_POST['ID'];
            $Order = Order::find($ID);
            if( $Order != null ){
            if($Order->Done == 0){
            $Order->Done = 1;
        }else {$Order->Done = 0; }
        $Order->save();
        return response()->json(['Operation Done Successfully']);
    }else return redirect('/');
    }}


    public function DeleteOrder()
    {    
        $Order = Order::where('User_id' , auth()->user()->id)->orderBy('id', 'DESC')->first();
        $item = Items::where('Order_id' , $Order->id)->get();
        $item->delete();
        $Order->delete();
        
    }

    

    public function SubOrder()
    {    if(request()->ajax() && session()->has('cart') && session()->has('Order') ) 
        {   
            $items = $this->ProQuantityValidation();
            if($items != null)
            {
                alert()->error('Quantity Error',json_encode($items));
               return redirect('/Cart');
                                   
            }
            $Cart = new Cart(session()->get('cart')); 
            $Data = session()->get('Order');
            $Order = new Order;
            $Order->User_id =  $Data['User_id'];
            $Order->PhoneNumber =  $Data['PhoneNumber'];
            $Order->Address = $Data['Address'];
            $Order->City =  $Data['City'];
            $Order->State = $Data['State'];
            $Order->Zip =  $Data['Zip'];
            $Order->Total = $Cart->totalPrice ;  
            $Order->save();

            $this->OrderItems($Cart);
            session()->forget('cart');
            session()->forget('Order');
            return response()->json(['Order Has Been Submitted Successfully']);
                       
        } return response()->json(['Unauthorized Operation!!']);
  
    }
    
    
    public function ProQuantityValidation()
    {   
        $Cart = new Cart(session()->get('cart')); 
        $items = [];   
            
            foreach($Cart->items as $ite){
                $Product = Product::find($ite['id'])->Quantity;
                if($Product - $ite['Quantity'] < 0){
                    $items[ $ite['Name']] =  'Quantity Not Available (Available just '.$Product.')';
                }
            }
           return $items;
    }

    
    public function OrderItems($Cart)
    {
        
        $Order = Order::where('User_id' , auth()->user()->id)->orderBy('id', 'DESC')->first();
        foreach ($Cart->items as $CartItem){ 
            $item = new Items;
            $item->Product_id =  $CartItem['id'];
            $item->Product_Price =  $CartItem['Price'];	
            $item->Quantity =  $CartItem['Quantity'];	
            $item->Order_id = $Order->id;
            $item->save();
            $Product = Product::find($CartItem['id']);
            $Product->Quantity -=  $CartItem['Quantity'];
            $Product->save();		
        }
        
    }

    /*
    public function charge(Request $request)
    {
          $this->SubOrder();
        //dd($request->stripeToken);
        $charge = Stripe::charges()->create([
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount'   => $request->amount,
            'description' => ' Test from laravel new app'
        ]);

        $chargeId = $charge['id'];

        if ($chargeId) {
            return redirect()->route('store')->with('success', " Payment was done. Thanks");
        } else {
            $this->DeleteOrder();
            return redirect()->back();
        }
    }
*/
}
