<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServicesController;

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
Route::get('/service', [ServicesController::class, 'ServiceIndex']);
Route::get('/getServicesData', [ServicesController::class, 'getServicesData']);
Route::post('/deleteServicesData', [ServicesController::class, 'ServicesDelete']);
Route::post('/singleServicesData', [ServicesController::class, 'singleServicesData']);
Route::post('/updateServicesData', [ServicesController::class, 'ServicesUpdate']);
Route::post('/addServices', [ServicesController::class, 'addServices']);