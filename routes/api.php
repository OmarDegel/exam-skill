<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\SkillController;
use App\Http\Controllers\api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/categories', [CategoryController::class,"index"]);
Route::get('/categories/show/{id}', [CategoryController::class,"show"]);

Route::get('/skills', [SkillController::class,"index"]);
Route::get('/skill/show/{id}', [SkillController::class,"show"]);

Route::get('/exam/show/{id}', [ExamController::class,"show"]);
Route::get('/exams/show', [ExamController::class,"index"]);

// Route::prefix('auth')->middleware("api")->group(function () {
    
//     Route::post("/register" ,[AuthController::class,"register"]);
//     Route::get("/logout" ,[AuthController::class,"logout"]);
//     Route::post("/login" ,[AuthController::class,"login"]);
    
// });

Route::middleware('authApi')->group(function(){
    Route::post('/exam/start/{id}', [ExamController::class,"start"])->middleware("ApiCanEnter");
    Route::get('/exam/showQuestions/{id}', [ExamController::class,"showQues"]);
    Route::post('/exam/submit/{id}', [ExamController::class,"submit"])->middleware("ApiCanSubmit");
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,"login"]);
    Route::post('logout', [AuthController::class,"logout"])->middleware("authApi");
    Route::post('refresh', [AuthController::class,"refresh"]);
    Route::post('me', [AuthController::class,"me"]);

});

Route::middleware("authApi:api")->get("/user",function(Request $request){
    return $request->user();
});