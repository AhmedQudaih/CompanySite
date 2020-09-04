<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AddCategory(Request $request)
    {   if(auth()->user()->admin == 1){ 
        $this->validate($request,[
            'Name' => 'required'
            ]);
       $Category = new Category;
       $Category->Name = $request->input('Name');
       $Category->save();
       return response()->json(['Category Has Been Added Successfully']);
        }return response()->json(['Unauthorized Operation!!']);
    
    }
    
    public function DeleteCategory()
    { if(auth()->user()->admin == 1 && request()->ajax() ){
        $ID =  $_POST['ID']; 
       $Category = Category::find($ID);
       if($Category != null){
       $Category->delete();
       return response()->json(['Category Has Been Deleted Successfully']);
        } 
        }return response()->json(['Unauthorized Operation!!']);
      
    }

    public function EditCategory(){
        if(auth()->user()->admin == 1 && request()->ajax() ){
        $ID =  $_POST['Categoryid'];
        $name =  $_POST['Name'];
        $Category = Category::find($ID);
        if($Category != null){
        $Category->name = $name;
        $Category->save();
        return response()->json(['Category Has Been Edit Successfully']);
        } 
        } return response()->json(['Unauthorized Operation!!']);
    }
    
}
