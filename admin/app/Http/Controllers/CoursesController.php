<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;

class CoursesController extends Controller
{
    function CourseIndex(){
        return view('Courses');
    }


    function getCoursesData(){

      $coursesData = json_encode(CoursesModel::orderBy('id', 'desc')->get());

      return $coursesData;

    }


    public function singleCoursesData(Request $request){

        $id = $request->input('id');
        $result = json_encode(CoursesModel::where('id', '=', $id)->get());

        return $result;

    }

    public function CoursesDelete(Request $request){

        $serviceID = $request->input('id');

        $result = CoursesModel::where('id', '=', $serviceID)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }


    public function CoursesUpdate(Request $request){

        $id = $request->input('courseid');
        $coursename = $request->input('coursename');
        $coursedesc = $request->input('coursedesc');
        $coursefee = $request->input('coursefee');
        $courseenroll = $request->input('courseenroll');
        $courseclass = $request->input('courseclass');
        $courselink = $request->input('courselink');
        $courseimg = $request->input('courseimg');

        $result = CoursesModel::where('id', '=', $id)->update([
            'course_name'=>$coursename,
            'course_desc'=>$coursedesc,
            'course_fee'=>$coursefee,
            'course_totalenroll'=>$courseenroll,
            'course_totalclass'=>$courseclass,
            'course_link'=>$courselink,
            'course_img'=>$courseimg
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    public function addCourses(Request $request){

        
        $coursename = $request->input('coursename');
        $coursedesc = $request->input('coursedesc');
        $coursefee = $request->input('coursefee');
        $courseenroll = $request->input('courseenroll');
        $courseclass = $request->input('courseclass');
        $courselink = $request->input('courselink');
        $courseimg = $request->input('courseimg');

        $result = CoursesModel::insert([

            'course_name'=>$coursename,
            'course_desc'=>$coursedesc,
            'course_fee'=>$coursefee,
            'course_totalenroll'=>$courseenroll,
            'course_totalclass'=>$courseclass,
            'course_link'=>$courselink,
            'course_img'=>$courseimg
            
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }



}
