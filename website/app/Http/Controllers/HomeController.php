<?php

namespace App\Http\Controllers;

use App\Models\CoursesModel;
use App\Models\ServicesModel;
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

        return view('home',[
            'servicesData'=>$servicesData,
            'coursesData' => $coursesData
        ]);
    }
}
