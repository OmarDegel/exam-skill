<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\MainController;

class DashController extends MainController
{
    public function index(){
        return view("admin.Home.show");
    }
}
