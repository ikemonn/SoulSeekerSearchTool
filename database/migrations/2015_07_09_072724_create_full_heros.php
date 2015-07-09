<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullHeros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_heros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type');
            $table->integer('attack_speed');
            $table->integer('move_speed');
            $table->integer('critical');
            $table->integer('attack_critical_rank');

            // 攻撃
            $table->integer('attack');
            $table->integer('attack_rank');
            $table->integer('attack_support');
            $table->integer('attack_support_rank');

            // 防御
            $table->integer('defence');
            $table->integer('defence_rank');
            $table->integer('defence_support');
            $table->integer('defence_support_rank');

            // 体力
            $table->integer('hp');
            $table->integer('hp_rank');
            $table->integer('hp_support');
            $table->integer('hp_support_rank');


            $table->integer('support_nature_rank');
            $table->integer('leader_nature_rank');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
