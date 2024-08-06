<?php

namespace App\Http\Controllers\admin;

use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\QuesRequest;
use App\Http\traits\Media;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminExamController extends MainController
{
    
    public function index()
    {
        $exams=Exam::orderByDesc("id")->paginate(15);
        $skills=Skill::get();
        return view("admin.exam.index",compact("exams","skills"));
    }

    
    public function create()
    {
        $skills=Skill::get();
        return view("admin.exam.create",compact("skills"));
    }
    public function createQues($id)
    {
        $exam=Exam::where("id",$id)->first();
        if(session("prev") !== "exam/$exam->id"){
            return redirect(url("dashboard/exam"));
        }
        $exam_id=$exam->id;
        $question_no=Exam::where("id",$id)->first()->question_no;
        return view("admin.exam.createQue",compact("exam_id","question_no"));
    }

    
    public function storeQues(QuesRequest $request ,$id)
    {
        $exam=Exam::where("id",$id)->first();
        $question_no=$exam->question_no;

        for($i=0 ;$i < $question_no ; $i++ ){
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->titles[$i],
                'option_1' => $request->option_1s[$i],
                'option_2' => $request->option_2s[$i],
                'option_3' => $request->option_3s[$i],
                'option_4' => $request->option_4s[$i],
                'right_ans' => $request->right_answers[$i],
            ]);
        }

        $exam->update([
            "active" =>1
        ]);

        event(new  ExamAddedEvent);
        return redirect(url("dashboard/exam"));

    
    }
    public function store(ExamRequest $request)
    {
        $image=$request->file('img')->store('exams','public');

        $exam=Exam::create([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar,
                
            ]),
            "description"=>json_encode([
                "en" => $request -> desc_en,
                "ar" => $request -> desc_ar,
                
            ]),
            "question_no" =>$request->questions_no,
            "difficulty" =>$request->difficulty,
            "duration_mins" =>$request->duration_mins,
            "skill_id" =>$request->skill_id,
            'img'=> $image,
            'active'=> 0,
        ]);
        $request->session()->flash("prev","exam/$exam->id");
        return redirect(url("dashboard/create/exam/{$exam->id}/questions"));
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam=Exam::where("id",$id)->first();
        return view("admin.exam.show",compact("exam"));
    }
    public function showQues(string $id)
    {
        $exam=Exam::where("id",$id)->first();
        // $ques=$exam->questions();
        $ques=Question::where("exam_id",$exam->id)->get();
        return view("admin.exam.showQus",compact("ques","exam"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exam=Exam::where("id",$id)->first();
        $skills=Skill::get();
        return view("admin.exam.editExam",compact("exam","skills"));
    }
    public function editQues(string $id , $ques_id)
    {
        $exam=Exam::where("id",$id)->first();
        $que=Question::where("id",$ques_id)->first();
        return view("admin.exam.editQues",compact("exam","que"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, string $id)
    {
        
        $exam=Exam::where("id",$id)->first();

        $newImagePath=$this->editPhoto($exam->photo,$request);

         Exam::where("id" , $id)->update([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar,
                
            ]),
            "description"=>json_encode([
                "en" => $request -> desc_en,
                "ar" => $request -> desc_ar,
                
            ]),
            "question_no" =>$request->questions_no,
            "difficulty" =>$request->difficulty,
            "duration_mins" =>$request->duration_mins,
            "skill_id" =>$request->skill_id,
            'img'=> $newImagePath,
            'active'=> 0,
        ]);
        
        return $this->returnMessage("done");

    }
    public function updateQues(Request $request, string $id ,Exam $exam)
    {
        $que=Question::where("id",$id)->first();
        $exam_id=$que->exam_id;
        $request->validate([
            "title"=>"required|string",
            "right_answer"=>"required|string",
            'option_1'=>"required|string",
            'option_2'=>"required|string",
            'option_3'=>"required|string",
            'option_4'=>"required|string",
        ]);
        
        
        Question::where("id" , $id)->update([
                'title' => $request->title,
                'option_1' => $request->option_1,
                'option_2' => $request->option_2,
                'option_3' => $request->option_3,
                'option_4' => $request->option_4,
                'right_ans' => $request->right_answer,
        ]);
        return redirect(url("dashboard/exam/show/$exam_id/question"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id , Request $request)
    {
        try{
            $exam=Exam::where("id",$id)->first();
            $exam->delete();
            $this->deletePhoto($exam);
                $msg="done deleted";
        }catch(Exception $e){
        $msg="cant deleted";
    }

                return $this->returnMessage("msg");
    }
    public function deleteQue(string $id , Request $request)
    {
        try{
            Question::where("id",$id)->delete();
            $msg="done deleted";
        }catch(Exception $e){
            $msg="cant deleted";
        }
        
        return $this->returnMessage("msg");

    }

    public function toggle($id){
        $model=Exam::where("id",$id);
        return $this->ToggleMain($model);
    }
    
}
