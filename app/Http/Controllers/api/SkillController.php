<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(){
        $skills=Skill::get();
        return SkillResource::collection($skills);
    }

    Public function show($id){
        $skill=Skill::where("id",$id)->with("exams")->first();
        return new SkillResource($skill);
    }
}
