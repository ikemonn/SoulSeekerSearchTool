<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Redis;

class Search extends Model
{
    protected $table = 'full_heros';
    protected $fillable = ['name', 'type', 'attack_speed', 'move_speed', 'critical', 'attack', 'attack_support', 'defence', 'defence_support', 'hp', 'hp_support', 'rarity'];
    public $timestamps = false;

    // rankingテーブルとのjoinクエリ
    public function scopeJoinRanking($query) {
        return $query->join('ranking', 'full_heros.id', '=', 'ranking.id');
    }

	// IDの昇順クエリ
    public function scopeIdAsc($query) {
    	return $query->orderBy('full_heros.id', 'asc');
    }

    // IDソート全件表示
    public function selectAll() {
    	return $this->translateTypeName(Search::joinRanking()->idAsc()->get());
    }

    // 名前であいまい検索
    public function fuzzySearchByName($name) {
    	return $this->translateTypeName(Search::joinRanking()->where('name', 'like', '%' . $name . '%')->get());
    }

    // 指定されたレア度の情報を取得
    public function searchByRarity($rarity) {
    	return $this->translateTypeName(Search::joinRanking()->where('rarity', '=', $rarity)->idAsc()->get());
    }

    // リーダー資質ランキングでソート
    public function sortLeaderRank($rarity) {
    	return $this->translateTypeName(Search::joinRanking()->where('rarity', '=', $rarity)->orderBy('ranking.leader_rank','asc')->idAsc()->get());
    }

    // サポ資質ランキングでソート
    public function sortSupportRank($rarity) {
    	return $this->translateTypeName(Search::joinRanking()->where('rarity', '=', $rarity)->orderBy('ranking.support_rank','asc')->idAsc()->get());
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

    public function delateAllData() {
        Search::truncate();
    }

    // キャラデータをinsertする
    public function insertData($chara_data) {

            $new_chara_data = Search::firstOrNew(['id' => $chara_data[0]]);
            $new_chara_data->id = $chara_data[0];
            $new_chara_data->name = $chara_data[1];
            $new_chara_data->type = $chara_data[2];
            $new_chara_data->attack_speed = $chara_data[3];
            $new_chara_data->move_speed = $chara_data[4];
            $new_chara_data->critical = $chara_data[5];
            $new_chara_data->attack = $chara_data[6];
            $new_chara_data->attack_support = $chara_data[7];
            $new_chara_data->defence = $chara_data[8];
            $new_chara_data->defence_support = $chara_data[9];
            $new_chara_data->hp = $chara_data[10];
            $new_chara_data->hp_support = $chara_data[11];
            $new_chara_data->rarity = $chara_data[12];
            $new_chara_data->save();

    }
}
