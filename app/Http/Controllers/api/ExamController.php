<?php

namespace App\Http\Controllers\api;

use App\Http\traits\Api;
use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    use Api;
    public function index()
    {
        $popularExams=Exam::withCount('users')->orderBy('users_count','desc')->get();
        return ExamResource::collection($popularExams);
    }
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
        $user=Auth::guard("api")->user();
        if( ! $user->exams->contains($examid)){
        $user->exams()->attach($examid);
    }else{
        $user->exams()->updateExistingPivot($examid,[
            "status"=>"closed"
        ]);
        
    }
    $exam=Exam::with('questions')->find($examid);
    return new ExamResource($exam);

        
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

        $user=Auth::guard("api")->user();

        $pivotRaw=$user->exams()->where("exam_id",$examid)->first();

        $startTime=$pivotRaw->pivot->created_at;

        $submitTime=Carbon::now();

        
        
        
        $timeMins=$submitTime->diffInMinutes($startTime);
        
        $user->exams()->where("exam_id",$examid)->updateExistingPivot($examid,[
            "score"=>$mark,
            'time_mins'=>$timeMins

        ]);
        return $this->SuccessMsg("u get $mark");

        
    }
}
