<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CoursesController;


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
Route::get('/visitor', [VisitorController::class, 'Visitor']);

//services data route.....
Route::get('/service', [ServicesController::class, 'ServiceIndex']);
Route::get('/getServicesData', [ServicesController::class, 'getServicesData']);
Route::post('/deleteServicesData', [ServicesController::class, 'ServicesDelete']);
Route::post('/singleServicesData', [ServicesController::class, 'singleServicesData']);
Route::post('/updateServicesData', [ServicesController::class, 'ServicesUpdate']);
Route::post('/addServices', [ServicesController::class, 'addServices']);

//courses data routes........


Route::get('/courses', [CoursesController::class, 'CourseIndex']);
Route::get('/getCoursesData', [CoursesController::class, 'getCoursesData']);
Route::post('/deleteCoursesData', [CoursesController::class, 'CoursesDelete']);
Route::post('/singleCoursesData', [CoursesController::class, 'singleCoursesData']);
Route::post('/updateCoursesData', [CoursesController::class, 'CoursesUpdate']);
Route::post('/addCourses', [CoursesController::class, 'addCourses']);