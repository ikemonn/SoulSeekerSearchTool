<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Redirect;

class CSVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        var_dump("CSVController index()");
        // GET ALL THE INPUT DATA , $_GET,$_POST,$_FILES.
        $input = Input::all();

    //     // VALIDATION RULES
    //     $rules = array(
    //         'file' => 'required',
    //     );
       //
    //     var_dump($input);
    //     exit;
    //    // PASS THE INPUT AND RULES INTO THE VALIDATOR
    //     $validation = Validator::make($input, $rules);
       //
    //     // CHECK GIVEN DATA IS VALID OR NOT
    //     if ($validation->fails()) {
    //         return Redirect::to('/import')->with('message', $validation->errors->first());
    //     }


        $file = array_get($input,'csv');
        var_dump($file);
        // SET UPLOAD PATH
        $set_path = public_path('../csv/');
        // GET THE FILE EXTENSION
        $extension = $file->getClientOriginalName();
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        // $fileName = rand(11111, 99999) . '.' . $extension;
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $upload_success = $file->move($set_path, $extension);
        var_dump($extension);
        var_dump($set_path);
        exit;
        // IF UPLOAD IS SUCCESSFUL SEND SUCCESS MESSAGE OTHERWISE SEND ERROR MESSAGE
        if ($upload_success) {
            return Redirect::to('/import')->with('message', 'Image uploaded successfully');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
