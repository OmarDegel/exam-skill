<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;
use App\Models\Cat;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats=Cat::get();
        return CatResource::collection($cats);
    }

    
    public function show(string $id)
    {
        $cat=Cat::where("id",$id)->with("skills")->first();
        return new CatResource($cat);
    }

    
    
}
