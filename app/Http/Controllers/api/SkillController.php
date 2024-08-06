<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\traits\Api;
use App\Models\Skill;

class SkillController extends Controller
{
    use Api;
    public function index(){
        $skills=Skill::get();
        return $this->Data(compact("skills"));
    }

    Public function show($id){
        $skill=Skill::where("id",$id)->with("exams")->first();
        return $this->Data(compact("skill"));
        }
}
