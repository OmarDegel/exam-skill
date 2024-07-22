<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id){
        $user=User::where("id",$id)->first();
        return view("web.profile.index",compact("user"));
    }
}
