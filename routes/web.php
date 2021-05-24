<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher;
use App\Http\Controllers\Student;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class,'index'] );

Route::get('/teacher/login',[Teacher\LoginController::class,'loginform']);
Route::post('/teacher/login',[Teacher\LoginController::class,'login']);
Route::post('/teacher/logout',[Teacher\LoginController::class,'logout']);
Route::post('/teacher/signup',[Teacher\LoginController::class,'signup']);

Route::prefix('/teacher/')->group(function(){
    Route::middleware('auth.teacher')->group(function(){
        Route::get('/',[Teacher\MainController::class,'index']);
        Route::get('/newprojects/',[Teacher\ProjectController::class,'new_projects']);
        Route::get('/projects',[Teacher\ProjectController::class,'projects']);
        Route::get('/projects/{id}',[Teacher\ProjectController::class,'show']);
        Route::get('/projects/{id}/approve',[Teacher\ProjectController::class,'approve']);

        Route::get('/projects/{project_id}/phases/{phase_id}/approve',[Teacher\PhaseController::class,'approve']);

        Route::get('/messages',[Teacher\MessageController::class,'index']);
        Route::get('/messages/{student_id}',[Teacher\MessageController::class,'chat']);
        Route::post('/messages/{student_id}',[Teacher\MessageController::class,'send']);
    });
});

Route::get('/student/login',[Student\LoginController::class,'loginform']);
Route::post('/student/login',[Student\LoginController::class,'login']);
Route::post('/student/logout',[Student\LoginController::class,'logout']);
Route::post('/student/signup',[Student\LoginController::class,'signup']);

Route::prefix('/student/')->group(function(){
Route::middleware('auth.student')->group(function(){
    Route::get('/',[Student\MainController::class,'index']);
    Route::get('/projects',[Student\ProjectController::class,'index']);
    Route::get('/projects/new',[Student\ProjectController::class,'create']);
    Route::post('/projects/store',[Student\ProjectController::class,'store']);
    Route::get('/projects/{id}',[Student\ProjectController::class,'manage_project']);
    Route::post('/projects/{id}',[Student\ProjectController::class,'update_project']);
    Route::get('/projects/{project_id}/phases/new',[Student\PhaseController::class,'create']);
    Route::post('/projects/{project_id}/phases/new',[Student\PhaseController::class,'store']);
    Route::get('/projects/{project_id}/phases/{phase_id}',[Student\PhaseController::class,'edit']);
    Route::post('/projects/{project_id}/phases/{phase_id}',[Student\PhaseController::class,'update']);

    Route::get('/messages',[Student\MessageController::class,'index']);
    Route::get('/messages/{teacher_id}',[Student\MessageController::class,'chat']);
    Route::post('/messages/{teacher_id}',[Student\MessageController::class,'send']);
});


});
