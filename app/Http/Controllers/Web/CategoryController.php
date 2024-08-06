<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $cats=Cat::active()->paginate(6);
        return view("web.cat.index",compact("cats"));
    }
    public function show($id){
        $cat=Cat::where("id",$id)->first();
        $cats=Cat::active()->get();
        $skills=Skill::active()->where("cat_id",$id)->paginate(6);
        return view("web.cat.show",compact("cat","cats","skills"));
    }
}
