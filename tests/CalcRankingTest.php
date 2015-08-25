<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Seeder;

use App\Search;
use App\Http\ControllersDB;

use App\Http\Controllers\CalcRankingController;

class CalcRankingTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->seed(__CLASS__ . 'Seeder');
    }

    /**
     * ランキングの計算
     */
    public function testIndex()
    {
        // ランキングデータの挿入
        DB::table('ranking')->delete();
        $calc = new CalcRankingController;
        $calc->index();

        $chara1 = DB::table('ranking')->where('id', '=', '26')->get();
        $this->assertEquals($chara1[0]->leader_rank, 1);
        $this->assertEquals($chara1[0]->support_rank, 61);

        $chara2 = DB::table('ranking')->where('id', '=', '43')->get();
        $this->assertEquals($chara2[0]->leader_rank, 62);
        $this->assertEquals($chara2[0]->support_rank, 14);

        $chara3 = DB::table('ranking')->where('id', '=', '5')->get();
        $this->assertEquals($chara3[0]->leader_rank, 45);
        $this->assertEquals($chara3[0]->support_rank, 42);

    }


}

class CalcRankingTestSeeder extends Seeder
{
    public function run()
    {
        // CSVからキャラデータを取得してDBに格納
        DB::statement('TRUNCATE full_heros RESTART IDENTITY CASCADE');
        $file = new SplFileObject('/home/vagrant/Code/0824_SoulSeeker_full.csv');
        $file->setFlags(SplFileObject::READ_CSV);
        foreach ($file as $line) {
            list($id, $name, $type, $attack_speed, $move_speed, $critical, $attack, $attack_support, $defence, $defence_support, $hp, $hp_support) = $line;

            switch ($type) {
                case '攻撃型':
                    $type = 1;
                    break;
                case '防御型':
                    $type = 2;
                    break;
                case '万能型':
                    $type = 3;
                    break;
                case 'サポート型':
                    $type = 4;
                    break;
                default:
                    # code...
                    break;
            }

            DB::table('full_heros')->insert(
                [
                    'id' => $id,
                    'name' => $name,
                    'type' => $type,
                    'attack_speed' => $attack_speed,
                    'move_speed' => $move_speed,
                    'critical' => $critical,
                    'attack' => $attack,
                    'attack_support' => $attack_support,
                    'defence' => $defence,
                    'defence_support' => $defence_support,
                    'hp' => $hp,
                    'hp_support' => $hp_support,
                    'created_at' => date("Y-m-d"),
                    'updated_at' => date("Y-m-d")
                ]
            );
        }
    }

}
