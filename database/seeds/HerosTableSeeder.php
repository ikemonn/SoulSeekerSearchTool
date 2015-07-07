<?php

use Illuminate\Database\Seeder;

class HerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('heros')->insert([
    		'name' => "侯爵ドミトリー",
    		'type' => 1,
			'attack_speed' => 10,
			'move_speed' => 20,
			'critical_speed' => 30,
			'attack' => 40,
			'defence' => 50,
			'hp' => 60,
			'attack_support' => 70,
			'defence_support' => 80,
			'hp_support' => 90,
    	]);

    }
}
