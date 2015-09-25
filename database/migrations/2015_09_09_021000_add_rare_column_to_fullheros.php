<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRareColumnToFullheros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('full_heros', function($table)
        {
            $table->dropTimestamps();

            if (Schema::hasColumn('full_heros', 'rarity') === false)
            {
                $table->integer('rarity')->nullable();
            }
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
