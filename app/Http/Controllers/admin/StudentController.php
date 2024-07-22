<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentRole=Role::where("name","student")->first();
        $students=User::where("role_id",$studentRole->id)->orderByDesc("id")->paginate(10);
        return view("admin.student.index",compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    
    /**
     * Store a newly created resource in storage.
     */
    
    /**
     * Display the specified resource.
     */
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
