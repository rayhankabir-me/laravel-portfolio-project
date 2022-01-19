<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactsModel;

class ContactsController extends Controller
{
   public function ContactIndex(){


    return view('Contacts');
   }


       function getContactsData(){

      $projectsData = json_encode(ContactsModel::orderBy('id', 'desc')->get());

      return $projectsData;

    }


    public function ContactsDelete(Request $request){

    $contactID = $request->input('id');

    $result = ContactsModel::where('id', '=', $contactID)->delete();

    if($result == true){
        return 1;
    }else{
        return 0;
    }

}
}
