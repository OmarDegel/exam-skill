<?php

namespace App\Http\Controllers\admin;

use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams=Exam::orderByDesc("id")->paginate(15);
        $skills=Skill::get();
        return view("admin.exam.index",compact("exams","skills"));
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function storeQues(Request $request ,$id)
    {
        $exam=Exam::where("id",$id)->first();
        $question_no=$exam->question_no;
        $request->validate([
            "titles"=>"required|array",
            "titles.*"=>"required|string",
            "right_answers"=>"required|array",
            "right_answers.*"=>"required|in:1,2,3,4",
            'option_1s'=>"required|array",
            'option_1s.*'=>"required|string|max:255",
            'option_2s'=>"required|array",
            'option_2s.*'=>"required|string|max:255",
            'option_3s'=>"required|array",
            'option_3s.*'=>"required|string|max:255",
            'option_4s'=>"required|array",
            'option_4s.*'=>"required|string|max:255",
            
        ]);

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
    public function store(Request $request)
    {
        $request->validate([
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50",
            'img'=>"required|image|max:2048",
            'desc_en'=>"required|string|max:5000",
            'desc_ar'=>"required|string|max:5000",
            'duration_mins'=>"required|integer|min:5",
            'questions_no'=>"required|integer|min:2",
            'difficulty'=>"required|integer|min:1|max:5",
            'skill_id'=>"required|exists:skills,id"
        ]);

        
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50",
            'img'=>"nullable|image|max:2048",
            'desc_en'=>"required|string|max:5000",
            'desc_ar'=>"required|string|max:5000",
            'duration_mins'=>"required|integer|min:5",
            'questions_no'=>"required|integer|min:2",
            'difficulty'=>"required|integer|min:1|max:5",
            'skill_id'=>"required|exists:skills,id"
        ]);
        
        $exam=Exam::where("id",$id)->first();
        $oldImage = $exam->img;

    if ($request->hasFile('img')) {
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }
        $newImagePath = $request->file('img')->store('exams', 'public');
    } else {
        $newImagePath = $oldImage;
    }
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
        
        $request->session()->flash("msg","done");
        return redirect(url("dashboard/exam"));
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
            $oldImage = $exam->img;
            $exam->delete();
            Storage::disk('public')->delete($oldImage);
                $msg="done deleted";
        }catch(Exception $e){
        $msg="cant deleted";
    }

                $request->session()->flash("msg",$msg);
                return back();
    }
    public function deleteQue(string $id , Request $request)
    {
        try{
            Question::where("id",$id)->delete();
            $msg="done deleted";
        }catch(Exception $e){
            $msg="cant deleted";
        }
        
        $request->session()->flash("msg",$msg);
        return back();
    }

    public function toggle($id){
        $exam=Exam::where("id",$id)->first();
        
        Exam::where("id",$id)->update([
            "active" => ! $exam->active,
        ]);
        return redirect()->back();
    }
}
