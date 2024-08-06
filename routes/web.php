<?php

use App\Http\Controllers\admin\AdminCatController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminExamController;
use App\Http\Controllers\admin\AdminSkillController;
use App\Http\Controllers\admin\DashController;
use App\Http\Controllers\admin\MsgController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\Web\SkillController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['Lang']], function () {
Route::get("/",[HomeController::class,"index"])->name("Home");
Route::get("/categories/show/{id}",[CategoryController::class,"show"])->name("category.show");
Route::get("/skills/show/{id}",[SkillController::class,"show"])->name("skil.show");
Route::get("/exams/show/{id}",[ExamController::class,"show"])->name("examShow");
Route::get("/question/{id}",[ExamController::class,"Question"])->name("question.show")->middleware("auth","verified","student");
Route::get("/contact",[ContactController::class,"show"])->name("contact");
Route::post("/contact/create",[ContactController::class,"sendMsg"])->name("sendMsg");
Route::get("/profile/{id}",[ProfileController::class,"index"])->name("profile");
});
Route::get("/exams/start/{id}",[ExamController::class,"start"])->name("exam.start")->middleware("auth","verified","student","CanEnter");
Route::post("/exams/submit/{id}",[ExamController::class,"submit"])->name("exam.submit")->middleware("auth","verified","student");



Route::prefix("dashboard")->middleware(["Dash","auth","Lang"])->group(function(){
    Route::get('/', [DashController::class , "index"])->name("dashHome");

    Route::resource('/cat', AdminCatController::class);
    Route::get('/cat/toggle/{id}', [AdminCatController::class ,"toggle"])->name("cat.toggle");
    
    
    Route::resource('/skill', AdminSkillController::class);
    Route::get('/skill/toggle/{id}', [AdminSkillController::class ,"toggle"])->name("skill.toggle");
    Route::get('/skill/search', [AdminSkillController::class ,"search"])->name("skillSearch");
    
    
    Route::resource('/exam', AdminExamController::class);
    Route::get('/exam/toggle/{id}', [AdminExamController::class ,"toggle"])->name("exam.toggle");
    Route::get('/exam/show/{id}/question', [AdminExamController::class ,"showQues"])->name("examQues.show");
    Route::get('/create/exam/{id}/questions', [AdminExamController::class ,"createQues"])->name("examQues.create");
    Route::post('/store/exam/{id}/questions', [AdminExamController::class ,"storeQues"])->name("storeQue.create");
    Route::get('/edit/exam/{id}/questions/{ques_id}', [AdminExamController::class ,"editQues"])->name("examQues.edit");
    Route::post('/store/exam/{id}/questions/{ques_id}', [AdminExamController::class ,"updateQues"])->name("examQue.update");
    Route::delete('/delete/{ques_id}', [AdminExamController::class ,"deleteQue"])->name("ques.destroy");

    Route::resource('/student', StudentController::class);
    Route::get('/student/open-exam/{user_id}/{exam_id}', [StudentController::class ,"openExam"])->name("openExam");
    Route::get('/student/close-exam/{user_id}/{exam_id}', [StudentController::class ,"closeExam"])->name("closeExam");
    
    Route::middleware("superadmin")->group(function(){
    Route::resource('/admin', AdminController::class);
    Route::get('/admin/promote/{id}', [AdminController::class,"promote"])->name("adminPromote");
    Route::get('/admin/demote/{id}', [AdminController::class,"demote"])->name("adminDemote");
    });
    Route::resource('/msg', MsgController::class);
});





Route::get("/lang/set/{lang}",[LangController::class,"set"])->name("lang.set");
Auth::routes([
    "verify"=>true
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


