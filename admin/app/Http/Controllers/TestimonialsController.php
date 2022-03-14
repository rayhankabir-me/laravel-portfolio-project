<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    function TestimonialsIndex(){
        return view('Testimonials');
    }

    function getProjectsData(){

      $projectsData = json_encode(ProjectsModel::orderBy('id', 'desc')->get());

      return $projectsData;

    }
}
