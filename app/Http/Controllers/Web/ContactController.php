<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show(){
        $setting=Setting::first();
        return view("web.contact.show",compact("setting"));
    }
    public function sendMsg(Request $request){
        $validator=Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|email|max:255",
            "subject"=>"required|string|max:255",
            "body"=>"required|string",
        ]);
        if($validator->fails()){
            $erorrs=$validator->errors();
            return redirect(url("contact"))->withErrors($erorrs);
        }
        Message::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "body"=>$request->body,
        ]);
        $request->session()->flash("success","your msg has sent");
        return back();

    }
}
