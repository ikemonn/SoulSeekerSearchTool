<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Redis;

class Search extends Model
{
    protected $table = 'full_heros';

	// IDの昇順クエリ
    public function scopeIdAsc($query) {
    	return $query->orderBy('id', 'asc');
    }

    // IDソート全件表示
    public function selectAll() {
    	return $this->translateTypeName(Search::idAsc()->get());
    }

    // 名前であいまい検索
    public function fuzzySearchByName($name) {
    	return $this->translateTypeName(Search::where('name', 'like', '%' . $name . '%')->get());
    }

    // リーダー資質ランキングでソート
    public function sortLeaderRank() {
    	return $this->translateTypeName(Search::orderBy('leader_nature_rank','asc')->idAsc()->get());
    }

    // サポ資質ランキングでソート
    public function sortSupportRank() {
    	return $this->translateTypeName(Search::orderBy('support_nature_rank','asc')->idAsc()->get());
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
            $hero_data->type_name = $type;
        }
        return $heros;
    }
}
