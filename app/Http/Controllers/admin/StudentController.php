<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\MainController;
use App\Models\Role;
use App\Models\User;


class StudentController extends MainController
{
    
    public function index()
    {
        $studentRole=Role::where("name","student")->first();
        $students=User::where("role_id",$studentRole->id)->orderByDesc("id")->paginate(10);
        return view("admin.student.index",compact("students"));
    }

    
    public function show(string $id)
    {
        $student=User::where("id" , $id)->first();
        if($student->role->name !== "student"){
            return back();
        }
        $exams=$student->exams;
        return view("admin.student.stuStatus",compact("student","exams"));
    }



    public function openExam($student_id ,$exam_id){
        $student=User::where("id",$student_id)->first();
        $student->exams()->updateExistingPivot($exam_id,[
            "status"=>"opened"
        ]);
    return back();
    }
    public function closeExam($student_id ,$exam_id){
        $student=User::where("id",$student_id)->first();
        $student->exams()->updateExistingPivot($exam_id, [
            'status' => 'closed'
        ]);
        return back();
    }
}
