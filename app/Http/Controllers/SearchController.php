<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Search;
use Input;
use DB;

class SearchController extends Controller {

    // 一覧表示
    public function selectAll() {

        $input = \Request::all();
        if (empty($input['name']) === false) {
            return $this->selectName($input['name']);
        } else {
            // パラメタ無しでdomainにアクセスしてきた時は☆6のNoソートにリダイレクト
            $host = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
            return Redirect::to($host . $_SERVER["HTTP_HOST"] . '/rarity/6');
        }
    }

    // 名前のあいまい検索
    public function selectName($name) {

        $full_heros = new Search();
        $heros = $full_heros->fuzzySearchByName($name);
        return $this->returnSelectView($heros);
    }


    // リーダー資質ランキング
    public function sortLeaderRank($rarity) {
        // リダ資質ソート
        $sort = 'Leader';
        $full_heros = new Search();
        $heros = $full_heros->sortLeaderRank($rarity);
        return $this->returnSelectView($heros, $sort);
    }

    // サポート資質ランキング
    public function sortSupportRank($rarity) {
        // サポ資質ソート
        $sort = 'Support';
        $full_heros = new Search();
        $heros = $full_heros->sortSupportRank($rarity);

        return $this->returnSelectView($heros, $sort);
    }

    // レア度で取得
    public function selectRarity($rarity) {
        // var_dump('指定されたレア度は:'. $rarity);
        $full_heros = new Search();
        $heros = $full_heros->searchByRarity($rarity);
        return $this->returnSelectView($heros);
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
