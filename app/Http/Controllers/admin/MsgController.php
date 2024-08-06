<?php

namespace App\Http\Controllers\admin;

use App\Models\Message;
use App\Http\Requests\MsgRequest;
use App\Http\Controllers\MainController;

class MsgController extends MainController
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
    public function store(MsgRequest $request , $id)
    {
        $msg=Message::where("id",$id)->first();
        
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