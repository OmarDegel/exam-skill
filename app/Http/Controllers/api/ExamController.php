<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show(string $id)
    {
        $exam=Exam::where("id",$id)->first();
        return new ExamResource($exam);
    }
    public function showQues(string $id)
    {
        $exam=Exam::where("id",$id)->with("questions")->first();
        return new ExamResource($exam);
    }
    public function start($examid,Request $request){
        $user=Auth::user();
        if( ! $user->exams->contains($examid)){
        $user->exams()->attach($examid);
    }else{
        $user->exams()->updateExistingPivot($examid,[
            "status"=>"closed"
        ]);
    }
        
    }

    public function submit($examid , Request $request){

        
        $val=Validator::make($request->all(),[
            "answers" => "array",
            
        ]);

        if($val->fails()){
            return response()->json($val->errors());
        }



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

        $user=$request->user();

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
        return response()->json([
            "msg"=>"u submit exams successfully , your score is $mark"
        ]);

        // $request->session()->flash("success","your score is {$mark}");
        // return redirect(url("/exams/show/$examid"));
    }
}
