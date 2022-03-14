<?php

namespace App\Http\Controllers;

use App\Models\ProjectsModel;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function ProjectPage(){

        $projectsData = ProjectsModel::orderBy('id', 'desc')->get();
        return view('projects', ['projectsData' => $projectsData]);
    }
}
