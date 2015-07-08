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
        $name = Input::get('name');

        $heros = DB::table('heros')
                ->where('name', 'LIKE', $name)
                ->get();


        return view('select')->with('heros', $heros);
    }

    public function selectAll() {

        $heros = DB::table('heros')->get();
        return view('select')->with('heros', $heros);
    }


}