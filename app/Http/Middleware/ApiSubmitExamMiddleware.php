<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiSubmitExamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $examid=$request->route()->parameter("id");
        $user=Auth::guard("api")->user();
        $checkEnter=$user->exams()->where("exam_id",$examid)->first();
        if($checkEnter->pivot->score == null){
            return $next($request);
        }
        else{
            return response()->json([
                'message'=>'تم ارسال الامتحان من قبل '
            ]);    
        }
    }
}
