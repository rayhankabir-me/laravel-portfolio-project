<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConditionsController extends Controller
{
   public function ConditionPage(){
       return view('conditions');
   }
}
