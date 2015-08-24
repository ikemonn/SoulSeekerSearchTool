<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Seeder;

use App\Search;
use App\Http\ControllersDB;

use App\Http\Controllers\CalcRankingController;

class SearchTest extends TestCase
{
    public function setUp()
    {
       parent::setUp();
        $this->seed(__CLASS__ . 'Seeder');
    }

    /**
     * IDソート全件表示
     */
    public function testSelectAll()
    {
        $full_heros = new Search;
        $full_heros_data_list = $full_heros->selectAll();
        foreach ($full_heros_data_list as $key => $hero_data) {
            if ($hero_data->id === 1) {
                $this->assertEquals($hero_data->name, "侯爵ドミトリー");
            }

            if ($hero_data->id === 2) {
                $this->assertEquals($hero_data->name, "無敵のフューリー");
            }

            if ($hero_data->id === 3) {
                $this->assertEquals($hero_data->name, "酷寒のアイシス");
            }
        }
    }

    /**
     * リーダー資質ランキング
     */
    public function testLeaderRank()
    {
        $full_heros = new Search;
        $full_heros_data_list = $full_heros->sortLeaderRank();

        $this->assertEquals($full_heros_data_list[0]->name, "破壊女神ラナ");
        $this->assertEquals($full_heros_data_list[1]->name, "光速剣のシオン");
        $this->assertEquals($full_heros_data_list[2]->name, "勇猛のゼルガ");

    }

}

class SearchTestSeeder extends Seeder
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

        // ランキングデータの挿入
        DB::table('ranking')->delete();
        $calc = new CalcRankingController;
        $calc->index();

    }

}
