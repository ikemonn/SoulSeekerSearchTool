<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CalcRanking;
use App\Ranking;

class CalcRankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $characterData = [];
        // リーダーランキングを取得
        $leaderRanking = $this->setLeaderRanking();
        foreach ($leaderRanking as $id => $rank) {
            $characterData[$id]['leader_rank'] = $rank;
        }

        $supportRanking = $this->setSupportRanking();
        foreach ($supportRanking as $id => $rank) {
            $characterData[$id]['support_rank'] = $rank;
        }
        $ranking = new Ranking();
        $ranking->insertData($characterData);

    }

    // リーダーランキングのセット
    public function setLeaderRanking()
    {
        // 各ランキングを取得
        $calcRanking = new CalcRanking();
        $attackRankingData = $calcRanking->calcAttackRanking();
        $defenceRankingData = $calcRanking->calcDefenceRanking();
        $hpRankingData = $calcRanking->calcHpRanking();
        $attackSpeedCriticalData = $calcRanking->calcAttackSpeedCriticalRanking();

        // 各キャラ毎に上記の数を合計し、昇順でソートする
        $charaData = [];
        for ($i=1; $i <= count($attackRankingData); $i++) {
            $charaData[$i] = $attackRankingData[$i] + $defenceRankingData[$i] + $hpRankingData[$i] + $attackSpeedCriticalData[$i];
        }
        asort($charaData);

        // 順位付けを行う
        $ranking = $this->setAscRanking($charaData);

        return $ranking;
    }

    // サポートランキングのセット
    public function setSupportRanking()
    {
        // 各ランキングを取得
        $calcRanking = new CalcRanking();
        $attackSupportRankingData = $calcRanking->calcAttackSupportRanking();
        $defenceSupportRankingData = $calcRanking->calcDefenceSupportRanking();
        $hpSupportRankingData = $calcRanking->calcHpSupportRanking();

        // 各キャラ毎に上記の数を合計し、昇順でソートする
        $charaData = [];
        for ($i=1; $i <= count($attackSupportRankingData); $i++) {
            $charaData[$i] = $attackSupportRankingData[$i] + $defenceSupportRankingData[$i] + $hpSupportRankingData[$i];
        }
        asort($charaData);

        // 順位付けを行う
        $ranking = $this->setAscRanking($charaData);

        return $ranking;

    }

    // id => value 型の配列を渡すと、valueの昇順でランキングを付け、id => valueの配列を返す
    public function setAscRanking($list)
    {
        $sortRanking = [];
        $rank = 0;
        $reserve = 1; //キャリーオーバー用
        $prev = -1; //初回は必ず不一致となる値

        foreach ($list as $id => $value) {
            if ($value === $prev) {
              //前回と同じ点数ならキャリーオーバー
              $reserve++;
            } else {
              //不一致なら、順位の持ち越し分を足し合わせる
              $rank += $reserve;
              //キャリーオーバーの値をリセット
              $reserve = 1;
              //現在の値を『前回の値』として記憶
              $prev = $value;
            }
            $sortRanking[$id] = $rank;
        }
        // var_dump($sortRanking);
        return $sortRanking;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
