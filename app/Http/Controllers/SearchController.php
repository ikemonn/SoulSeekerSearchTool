<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use DB;

class SearchController extends Controller {

    // form表示
    public function input() {
        return view('input');
    }


    public function res() {
        $db_name = 'full_heros';

        $name = Input::get('name');

        $heros = DB::table($db_name)
                ->where('name', 'LIKE', $name)
                ->get();


        return view('select')->with('heros', $heros);
    }

    public function selectAll() {
        $db_name = 'full_heros';

        $heros = DB::table($db_name)->get();
        return view('select')->with('heros', $heros);
    }


}