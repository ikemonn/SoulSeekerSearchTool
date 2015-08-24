<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropRankingColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('full_heros', function ($table) {

            $table->dropColumn('attack_critical_rank');
            $table->dropColumn('attack_support_rank');
            $table->dropColumn('defence_support_rank');
            $table->dropColumn('hp_support_rank');
            $table->dropColumn('support_nature_rank');
            $table->dropColumn('leader_nature_rank');

            // $table->nullableTimestamps();
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
