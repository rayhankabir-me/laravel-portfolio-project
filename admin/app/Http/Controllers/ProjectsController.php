<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProjectsModel;

class ProjectsController extends Controller
{

    function ProjectIndex(){
        return view('Projects');
    }

    function getProjectsData(){

      $projectsData = json_encode(ProjectsModel::orderBy('id', 'desc')->get());

      return $projectsData;

    }

    public function singleProjectsData(Request $request){

        $id = $request->input('id');
        $result = json_encode(ProjectsModel::where('id', '=', $id)->get());

        return $result;

    }

    public function ProjectsDelete(Request $request){

        $serviceID = $request->input('id');

        $result = ProjectsModel::where('id', '=', $serviceID)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }



    public function ProjectsUpdate(Request $request){

        $id = $request->input('projectEditId');
        $ProjectEditNameId = $request->input('ProjectEditNameId');
        $ProjectEditDesId = $request->input('ProjectEditDesId');
        $ProjectEditLinkId = $request->input('ProjectEditLinkId');
        $ProjectEditImgId = $request->input('ProjectEditImgId');


        $result = ProjectsModel::where('id', '=', $id)->update([
            'project_name'=>$ProjectEditNameId,
            'project_desc'=>$ProjectEditDesId,
            'project_link'=>$ProjectEditLinkId,
            'project_img'=>$ProjectEditImgId,
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }



    public function addProjects(Request $request){

        
        $projectname = $request->input('projectname');
        $projectdesc = $request->input('projectdesc');
        $projectlink = $request->input('projectlink');
        $projectimg = $request->input('projectimg');


        $result = ProjectsModel::insert([

            'project_name'=>$projectname,
            'project_desc'=>$projectdesc,
            'project_link'=>$projectlink,
            'project_img'=>$projectimg,

            
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }



}
