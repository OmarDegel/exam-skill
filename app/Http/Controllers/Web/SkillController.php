<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id){
        $skill=Skill::where("id",$id)->first();
        $exams=Exam::active()->where("skill_id",$id)->paginate(6);
        return view("web.skill.show",compact("skill","exams"));
    }
}
