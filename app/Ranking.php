<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Ranking extends Model
{
    protected $table = 'ranking';
    protected $fillable = ['leader_rank', 'support_rank', 'id'];

    // データをinsertする
    public function insertData($charaDataList) {
        foreach ($charaDataList as $id => $charData) {
            $rankData = Ranking::firstOrNew(['id' => $id]);
            $rankData->leader_rank = $charData['leader_rank'];
            $rankData->support_rank = $charData['support_rank'];
            $rankData->save();
        }
    }

    public function delateAllData() {
        Ranking::truncate();
    }
}
