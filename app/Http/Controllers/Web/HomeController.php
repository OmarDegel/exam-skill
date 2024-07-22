<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;

class HomeController extends Controller
{
    public function index(){
        // $popularExams=Exam::withCount('users')
        //     ->orderBy('users_count', 'desc')
        //     ->paginate(8);
        $popularExams = new Exam();
        return view('web.home.index',["popularExams"=> $popularExams->getMostExams()]);
        
    }
}
