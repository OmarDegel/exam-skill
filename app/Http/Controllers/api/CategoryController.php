<?php

namespace App\Http\Controllers\api;

use App\Models\Cat;
use App\Http\traits\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CatResource;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use Api;
    public function index()
    {
        
        // $cats=Cat::get();
        // return CatResource::collection($cats);

        $lang=App::getLocale();
        $cats = Cat::select("id","name->$lang as name","active", "created_at", "updated_at")
        ->get();  
        return $this->Data(compact("cats"),__("api.allpro"));
    }

    
    public function show(string $id)
    {     
        $cat=Cat::where("id",$id)->with("skills")->first();
        return new CatResource($cat);

        
        // $lang=App::getLocale();
        // $cat=Cat::where("id",$id)
        // ->select("id","name->$lang as name","active", "created_at", "updated_at")
        // ->with(['skills' => function ($query) use ($lang) {
        // $query->select('id', "name->$lang as skill_name", "cat_id"); 
        // }])
        // ->first();
        // return $this->Data(compact("cat"));

    }

    
    
}
