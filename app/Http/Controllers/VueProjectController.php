<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueProjectController extends Controller
{
   /**
    * Display Homepage
    *
    * @return \Illuminate\Http\Response
    **/
   public function index()
   {
       return view('product');
   }
}
