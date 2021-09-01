<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailController extends Controller
{
    public function index()
    {
        return view('mail.sendemail');
    }

    public function send(Request $request)
    {
       
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required'
        ]);   

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        );

        Mail::to('nafisa@ufa-lanka.com')->send(new SendMail($data));

        return redirect('home')->with('success','Your mail has been sent. Thanks for contacting us!');
    }

    function sendNews()
    {
        Mail::to('nafisa@ufa-lanka.com')->send(new SendMail());
    }
}
