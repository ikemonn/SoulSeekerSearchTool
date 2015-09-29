<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Redirect;
use Excel;
use SplFileObject;
use App\Search;
use App\Ranking;
use App\Http\Controllers\CalcRankingController;

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
        // var_dump($extension);
        // var_dump($set_path);
        if ($upload_success) {


            $file = new SplFileObject($set_path . $extension);
            $file->setFlags(SplFileObject::READ_CSV);
            $search = new Search();

            $search->delateAllData();
            // ファイル内のデータループ
            foreach ($file as $key => $line) {
                if($line[0] > 0) {
                    $search->insertData($line);
                }
            }

            $ranking = new Ranking();
            $ranking->delateAllData();

            return Redirect::to('/calc')->with('message', 'Image uploaded successfully');
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
