<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CanEnter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $examid=$request->route()->parameter("id");
        $user=Auth::user();
        $checkEnter=$user->exams()->where("exam_id",$examid)->first();
        if($checkEnter !== null and $checkEnter->pivot->status == "closed" ){
            return redirect(url("/"));
        }
        return $next($request);
    }
}
