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
            if (Schema::hasColumn('full_heros', 'attack_critical_rank'))
            {
                $table->dropColumn('attack_critical_rank');
            }
            if (Schema::hasColumn('full_heros', 'attack_support_rank'))
            {
                $table->dropColumn('attack_support_rank');
            }
            if (Schema::hasColumn('full_heros', 'defence_support_rank'))
            {
                $table->dropColumn('defence_support_rank');
            }
            if (Schema::hasColumn('full_heros', 'hp_support_rank'))
            {
                $table->dropColumn('hp_support_rank');
            }
            if (Schema::hasColumn('full_heros', 'support_nature_rank'))
            {
                $table->dropColumn('support_nature_rank');
            }
            if (Schema::hasColumn('full_heros', 'leader_nature_rank'))
            {
                $table->dropColumn('leader_nature_rank');
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
