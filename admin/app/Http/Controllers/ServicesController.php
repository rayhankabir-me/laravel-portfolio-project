<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServicesController extends Controller
{



    public function getServicesData(){

        $result = json_encode(ServicesModel::all());

        return $result;

    }


    public function singleServicesData(Request $request){

        $id = $request->input('id');
        $result = json_encode(ServicesModel::where('id', '=', $id)->get());

        return $result;

    }

    public function ServiceIndex(){

        return view('service');
    }

    public function ServicesDelete(Request $request){

        $serviceID = $request->input('id');

        $result = ServicesModel::where('id', '=', $serviceID)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    public function ServicesUpdate(Request $request){

        $id = $request->input('serviceid');
        $name = $request->input('servicename');
        $des = $request->input('serviedesc');
        $img = $request->input('serviceimage');

        $result = ServicesModel::where('id', '=', $id)->update(['services_img'=>$img, 'services_name'=>$name, 'services_desc'=>$des]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }


    public function addServices(Request $request){

        
        $name = $request->input('servicename');
        $des = $request->input('serviedesc');
        $img = $request->input('serviceimage');

        $result = ServicesModel::insert(['services_img'=>$img, 'services_name'=>$name, 'services_desc'=>$des]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

}
