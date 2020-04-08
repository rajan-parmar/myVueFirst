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

    /**
     * Store the data
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     **/
    public function store(Request $request)
    {
        $data = new Data;
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'status' => 'success', 'message' => 'New todo list created'
        ]);
    }

    /**
     * Delete Todo Record
     *
     * @param var $id
     * @return \Illuminate\Http\JsonResponse
     **/
    public function destroy($id)
    {
       Data::destroy($id);

       return response()->json([
            'status' => 'success', 'message' => 'Record Deleted'
        ]);
    }
}
