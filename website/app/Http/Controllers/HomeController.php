<?php

namespace App\Http\Controllers;

use App\Models\ContactsModel;
use App\Models\CoursesModel;
use App\Models\ProjectsModel;
use App\Models\ServicesModel;
use App\Models\TestimonialsModel;
use App\Models\VisitorModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeIndex(){


        $user_ip = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $user_date = date('d-m-y h:i:s');

        VisitorModel::insert(['ip_address'=>$user_ip, 'visited_time'=>$user_date]);
        $servicesData = ServicesModel::all();

        /*....Get Courses Data...*/

        $coursesData = CoursesModel::orderBy('id', 'desc')->take(6)->get();

        /*...Get Projects Data...*/


        $projectsData = ProjectsModel::orderBy('id', 'desc')->take(8)->get();

        $testimonialsData = TestimonialsModel::orderBy('id', 'desc')->take(4)->get();

        return view('home',[
            'servicesData'=>$servicesData,
            'coursesData' => $coursesData,
            'projectsData'=>$projectsData,
            'testimonialsData'=>$testimonialsData
        ]);
    }

    public function ContactSubmit(Request $request){

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');

        $result = ContactsModel::insert([
            'name'=>$name,
            'phone'=>$phone,
            'email'=>$email,
            'message'=>$message
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }
}
