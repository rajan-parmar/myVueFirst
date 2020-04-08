<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;

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


    /**
     * fetch the data from Database
     *
     * @param Type $var Description
     * @return type
     **/
    public function todoList()
    {
        $data = Data::all();
        return response()->json($data);
    }
}
