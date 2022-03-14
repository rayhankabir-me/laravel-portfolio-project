<?php

namespace App\Http\Controllers;

use App\Models\CoursesModel;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function CoursePage(){

        $coursesData = CoursesModel::orderBy('id', 'desc')->get();

        return view('course', ['coursesData'=>$coursesData]);
    }
}
