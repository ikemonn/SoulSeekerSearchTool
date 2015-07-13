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

    // 一覧表示
    public function selectAll() {
        // No順ソート
        $sort = 'No';

        $db_name = 'full_heros';
        $heros = DB::table($db_name)
                    ->orderBy('id','asc')
                    ->get();
        return $this->returnSelectView($sort, $heros);
    }

    // リーダー資質ランキング
    public function sortLeaderRank() {
        // リダ資質ソート
        $sort = 'Leader';

        $db_name = 'full_heros';
        $heros = DB::table($db_name)
                    ->orderBy('leader_nature_rank','asc')
                    ->orderBy('id','asc')
                    ->get();
        return $this->returnSelectView($sort, $heros);
    }

    // サポート資質ランキング
    public function sortSupportRank() {
        // サポ資質ソート
        $sort = 'Support';

        $db_name = 'full_heros';
        $heros = DB::table($db_name)
                    ->orderBy('support_nature_rank','asc')
                    ->orderBy('id','asc')
                    ->get();

        return $this->returnSelectView($sort, $heros);
    }

    // selectViewにデータを返す
    private function returnSelectView($sort, $heros) {
        $this->translateTypeName($heros);
        return $this->returnValue('select',['sort'=> $sort, 'heros'=> $heros]);
    }

    // 値をviewに返す
    private function returnValue($view_name, $values) {
        return view($view_name)->with($values);
    }

    // タイプを対応するものに変換する
    private function translateTypeName($heros) {
        foreach ($heros as $hero_data) {
            $type = '';
            switch ($hero_data->type) {
                case 1:
                    $type = '攻撃型';
                    break;
                case 2:
                    $type = '防御型';
                    break;
                case 3:
                    $type = '万能型';
                    break;
                case 4:
                    $type = 'サポート型';
                    break;
                default:
                    $type = '不明';
                    break;
            }
            $hero_data->type = $type;
        }
    }

}