<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueFirstController extends Controller
{
    /**
     * Display Homepage
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        return view('index');
    }
}
