<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ConditionsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReturnPolicyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'HomeIndex']);

/*home Contact form submit*/
Route::post('/homeContact', [HomeController::class, 'ContactSubmit']);

/*Pages Routes*/
Route::get('/blog', [BlogController::class, 'BlogPage']);
Route::get('/courses', [CoursesController::class, 'CoursePage']);
Route::get('/projects', [ProjectsController::class, 'ProjectPage']);
Route::get('/return-policy', [ReturnPolicyController::class, 'ReturnPage']);
Route::get('/conditions', [ConditionsController::class, 'ConditionPage']);
