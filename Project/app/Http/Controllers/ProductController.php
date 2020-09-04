<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     
    public function index()
    {
        $Product = Product::all();
        return view('Home')->with('Product' , $Product);
    }

    public function ShowProducts()
    {   
        $Product = Product::all();
        $Category = Category::all();
        return view('Products')->with('Product' , $Product)->with('Category' , $Category);
    }

    public function ShowFilterdProducts($id)
    {
        $Product = Product::where('CategoryId' , $id )->get();
        if($Product != null){
        $Category = Category::all();
        return view('Products')->with('Product' , $Product)->with('Category' , $Category);
        }return redirect('Products');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*  public function create()
    {    if(Auth::check() && auth()->user()->admin == 1){ 
        $Category = Category::all();  
        return view('AddProduct')->with('Category' , $Category);
        } 
        else return redirect('/');
    }
*/






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    if(Auth::check() && auth()->user()->admin == 1){ 
        $this->validate($request,[
            'Name' => 'required|string|max:30',
            'Price' => 'required|numeric',
            'Quantity'=> 'required|numeric',
            'Details'=> 'required|string|max:255',
            'Category'=> 'required',
            'pic'=> 'nullable|max:1999'
            ]);
            
        if($request->hasFile('pic')){
            $FileNameWithExt = $request->file('pic')->getClientOriginalName();
            $FileName = pathinfo($FileNameWithExt , PATHINFO_FILENAME );
            $extension = $request->file('pic')->getClientOriginalExtension();
            $fileNameToStore = $FileName.'_'.time().'.'.$extension;
            $path = $request->file('pic')->storeAs('public/img' , $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.png';
        }

       $Category = Category::find( $request->input('Category'));
       $Category->NumbOfPro =  $Category->NumbOfPro + 1;
       $Category->save();
       $Product = new Product;
       $Product->Name = $request->input('Name');
       $Product->Price = $request->input('Price');
       $Product->Quantity = $request->input('Quantity');
       $Product->Details = $request->input('Details');
       $Product->CategoryId = $request->input('Category');
       $Product->Picture = $fileNameToStore;
       $Product->save();
        }
     return  redirect('/');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        
        $Product = Product::find($id);
        if($Product != null){
        return view('details')->with('Product',$Product);
        }return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   if(Auth::check() && auth()->user()->admin == 1){ 
        $Product = Product::find($id);
        if($Product != null){
        return view('UpdateProduct')->with('Product', $Product );}
        } return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check() && auth()->user()->admin == 1){ 
        $this->validate($request,[
            'Name' => 'required|string|max:30',
            'Price' => 'required|numeric',
            'Quantity'=> 'required|numeric',
            'Details'=> 'required|string|max:255',
            'Category'=> 'required',
            'pic'=> 'nullable|max:1999'
            ]);
         
            if($request->hasFile('pic')){
                $FileNameWithExt = $request->file('pic')->getClientOriginalName();
                $FileName = pathinfo($FileNameWithExt , PATHINFO_FILENAME );
                $extension = $request->file('pic')->getClientOriginalExtension();
                $fileNameToStore = $FileName.'_'.time().'.'.$extension;
                $path = $request->file('pic')->storeAs('public/img' , $fileNameToStore);
               
            }

           $Category = Category::find( $request->input('Category'));
           $Category->NumbOfPro =  $Category->NumbOfPro + 1;
           $Category->save();


           $Product = Product::find($id);
           $Category = Category::find( $Product->CategoryId);
           $Category->NumbOfPro =  $Category->NumbOfPro - 1;
           $Category->save();

           $Product->Name = $request->input('Name');
           $Product->Price = $request->input('Price');
           $Product->Quantity = $request->input('Quantity');
           $Product->Details = $request->input('Details');
           $Product->CategoryId = $request->input('Category');
           if($request->hasFile('pic')){
           $Product->Picture = $fileNameToStore;}
           $Product->save();
           }
             return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {   
        if(Auth::check() && auth()->user()->admin == 1 && request()->ajax() ){
            $id =  $_POST['ID']; 
        $Product = Product::find($id);
        if($Product != null){
        $Category = Category::find( $Product->CategoryId);
        $Category->NumbOfPro =  $Category->NumbOfPro - 1;
        $Category->save();
        $Product->delete();
        if($Product->Picture != 'noimage.png' ){
        Storage::delete('public/img/'.$Product->Picture);
        }}}
        return response()->json(['Product Has Been Deleted Successfully']);
    }

}

