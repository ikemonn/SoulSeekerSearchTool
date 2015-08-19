<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CalcRanking extends Model
{
    protected $table = 'full_heros';

    // 攻撃力のランク付け
    public function calcAttackRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by attack desc) as rank, id  from full_heros;"));

        return $this->formatRankingData($sortData);
    }

    // 防御力のランク付け
    public function calcDefenceRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by defence desc) as rank, id  from full_heros;"));

        return $this->formatRankingData($sortData);
    }

    // 体力のランク付け
    public function calcHpRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by hp desc) as rank, id from full_heros;"));

        return $this->formatRankingData($sortData);
    }

    // 攻撃速度+クリティカル率のランク付け
    public function calcAttackSpeedCriticalRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by attack_speed + critical desc) as rank, id  from full_heros;"));

        return $this->formatRankingData($sortData);
    }

    // 攻撃力サポートのランク付け
    public function calcAttackSupportRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by attack * attack_support desc) as rank, id  from full_heros;"));

        return $this->formatRankingData($sortData);
    }

    // 防御力サポートのランク付け
    public function calcDefenceSupportRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by defence * defence_support desc) as rank, id  from full_heros;"));

        return $this->formatRankingData($sortData);
    }

    // HPサポートのランク付け
    public function calcHpSupportRanking() {
        $sortData = DB::select(DB::raw("select rank() over (order by hp * hp_support desc) as rank, id  from full_heros;"));

        return $this->formatRankingData($sortData);
    }

	// 渡された配列を、id => ranking の配列にして返す
    public function formatRankingData($array) {
        $rankingData = [];
        foreach ($array as $elem) {
            $rankingData[$elem->id] = $elem->rank;
        }
        return $rankingData;
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
