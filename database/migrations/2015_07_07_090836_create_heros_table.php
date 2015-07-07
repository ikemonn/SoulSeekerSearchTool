<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type');
            $table->integer('attack_speed');
            $table->integer('move_speed');
            $table->integer('critical_speed');
            $table->integer('attack');
            $table->integer('defence');
            $table->integer('hp');
            $table->integer('attack_support');
            $table->integer('defence_support');
            $table->integer('hp_support');
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
        Schema::drop('heros');
    }
}
