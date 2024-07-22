<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MsgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $msgs=Message::orderByDesc("id")->paginate(15);
        return view("admin.msg.index",compact("msgs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , $id)
    {
        $msg=Message::where("id",$id)->first();
        $request->validate([
            "title"=>"required|string",
            "body"=>"required|string"
        ]);
        $receiverMail=$msg->email;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $msg=Message::where("id",$id)->first();
        return view("admin.msg.show",compact("msg"));
    }
}