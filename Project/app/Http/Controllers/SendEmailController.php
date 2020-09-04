<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    function Mail()
    {
        return view('ContactUs');
    }

    function SendMail(Request $request)
    {
        
         $this->validate($request, [
          'Title'     =>  'required',
          'Body'  =>  'required',
         ]);
    
            $details = array(
                'Title'      =>  $request->Title,
                'body'   =>   $request->Body
            );        
         \Mail::to('ahmedku0123@gmail.com')->send(new \App\Mail\MyTestMail($details));
         return back()->with('success', 'Thanks for contacting us!');
       
    
        
    }
}
