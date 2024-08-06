<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id){
        $exam=Exam::where("id",$id)->first();
        $canEnter=true;

        if(Auth::user() !== null){
            $checking=Auth::user()->exams()->where("exam_id",$id)->first();

                if($checking !== null and $checking->pivot->status == "closed"){
                    $canEnter=false;
                }}
        return view("web.exam.show",compact("exam","canEnter"));
    }
    public function start($examid , Request $request){
        // if( session("prev") !=="start/$examid" ){
        //     return redirect(url("/exams/show/$examid"));
        // }
        $user=Auth::user();
        if( ! $user->exams->contains($examid)){
        $user->exams()->attach($examid);
    }else{
        $user->exams()->updateExistingPivot($examid,[
            "status"=>"closed"
        ]);
    }
        $request->session()->flash("prev","start/$examid");
        return redirect(url("question/$examid"));
    }
    public function Question($id ,Request $request){
        if( session("prev") !=="start/$id" ){
            return redirect(url("/exams/show/$id"));
        }
        $exam=Exam::where("id",$id)->first();
        $questiones=Question::where("exam_id",$id)->get();
        $request->session()->flash("prev","/question/show/$id");
        return view("web.exam.exam-questions",compact("exam","questiones"));
    }
    public function submit($examid , Request $request){

        if( session("prev") !=="start/$examid" ){
            return redirect(url("/exams/show/$examid"));
        }

        $request->validate([
            "answers" => "array",
            
        ]);
        $score=0;
        $exam=Exam::findOrFail($examid);
        $examNum=$exam->questions->count();
        foreach($exam->questions as $question){
            if(isset($request->answers[$question->id])){

                    $userAns=$request->answers[$question->id];

                    $rightAns=$question->right_ans;
                    
                if($userAns == $rightAns){
                    $score += 1;
                }
            }
        }
        $mark=($score/$examNum)*100;
        $user=Auth::user();

        $pivotRaw=$user->exams()->where("exam_id",$examid)->first();

        $startTime=$pivotRaw->pivot->created_at;

        $submitTime=Carbon::now();

        
        
        
        $timeMins=$submitTime->diffInMinutes($startTime);
        // if($timeMins> $exam->duration_mins){
        //     $mark=0
        // }
        $user->exams()->where("exam_id",$examid)->updateExistingPivot($examid,[
            "score"=>$mark,
            'time_mins'=>$timeMins

        ]);
        $request->session()->flash("success","your score is {$mark}");
        return redirect(url("/exams/show/$examid"));
    }
}
