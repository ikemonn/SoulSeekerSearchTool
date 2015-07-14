<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Search;
use Input;
use DB;

class SearchController extends Controller {

    // 一覧表示
    public function selectAll() {
        // No順ソート
        $sort = 'No';

        $db_name = 'full_heros';
        $heros = DB::table($db_name)
                    ->orderBy('id','asc')
                    ->get();
        return $this->returnSelectView($heros, $sort);
    }

    // 一覧表示
    public function selectName($name) {

        $full_heros = new Search();
        $heros = $full_heros->fuzzySearchByName($name);
        return $this->returnSelectView($heros);
    }


    // リーダー資質ランキング
    public function sortLeaderRank() {
        // リダ資質ソート
        $sort = 'Leader';
        $full_heros = new Search();
        $heros = $full_heros->sortLeaderRank();
        return $this->returnSelectView($heros, $sort);
    }

    // サポート資質ランキング
    public function sortSupportRank() {
        // サポ資質ソート
        $sort = 'Support';

        $full_heros = new Search();
        $heros = $full_heros->sortSupportRank();

        return $this->returnSelectView($heros, $sort);
    }

    // selectViewにデータを返す
    private function returnSelectView($heros, $sort = null) {

        return $this->returnValue('select',['sort'=> $sort, 'heros'=> $heros]);
    }

    // 値をviewに返す
    private function returnValue($view_name, $values) {
        return view($view_name)->with($values);
    }

}