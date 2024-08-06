<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiCanEnter
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

        if($checkEnter !== null and $checkEnter->pivot->status == "closed" ){

            return response()->json([
                'message'=>'غير مسموحلك دخول هدا الامتحان'
            ]);    

        }elseif($checkEnter !== null){

            return response()->json([
                'message'=>'غير مسموحلك دخول هدا الامتحان'
            ]);    
        }
        return $next($request);
    }
}
