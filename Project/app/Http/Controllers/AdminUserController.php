<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Product;
use App\Category;
use App\Order;
use App\User;
use App\Items;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AdminList()
    {
        if(auth()->user()->admin == 1){
        $Product = Product::all();
        $Category = Category::all();
        $User = User::all();
        $Order = Order::all();
        $Items = Items::all();
        return view('AdminList')->with('User' , $User)->with('Product' , $Product)->with('Order' , $Order)->with('Items' , $Items);
        }
        return redirect('/');
    }
    public function RemoveUser()
    {   if(auth()->user()->admin == 1 && request()->ajax() ){ 
        $id =  $_POST['ID'];
        $User = User::find($id);
        if( $User != null ){
        $User->delete();
        return response()->json(['User Removed Successfully']);
        }
        }return response()->json(['Unauthorized Operation!!']);
       
    }

    public function EditUser($id){
        if(auth()->user()->id == $id){ 
        $User = User::find($id);
        if( $User != null ){
        return view('UpdateUser')->with('User' , $User);}
    } return redirect('/');
    }

    
    public function UpdateUser(Request $request ,$id)
    {    if(auth()->user()->id == $id){ 
        $this->validate($request,[
        'name' => 'required|string|max:20',
        'email' => 'required|string|email|max:50',
        'password' => 'nullable|string|min:8|confirmed'
        ]);
        
        $User = User::find($id);
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        if($request->input('password')!= null){
        $User->password = Hash::make($request->input('password'));
        }
        $User->save();
        }
        return redirect('/');
    }

    public function MakeAdmin(Request $request){
        if(auth()->user()->admin == 1 && request()->ajax() ){ 
            $ID =  $_POST['ID'];
            $User = User::find($ID);
            if( $User != null ){
            if($User->admin == 0){
            $User->admin = 1;
        }else {$User->admin = 0; }
        $User->save();
        return response()->json(['Operation Done Successfully']);
    }else return redirect('/');
    }}

}
