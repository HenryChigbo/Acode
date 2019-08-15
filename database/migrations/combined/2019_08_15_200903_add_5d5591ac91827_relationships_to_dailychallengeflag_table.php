<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d5591ac91827RelationshipsToDailyChallengeFlagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_challenge_flags', function(Blueprint $table) {
            if (!Schema::hasColumn('daily_challenge_flags', 'daily_challenge_id')) {
                $table->integer('daily_challenge_id')->unsigned()->nullable();
                $table->foreign('daily_challenge_id', '332948_5d4df9df2988e')->references('id')->on('daily_challenges')->onDelete('cascade');
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
        Schema::table('daily_challenge_flags', function(Blueprint $table) {
            if(Schema::hasColumn('daily_challenge_flags', 'daily_challenge_id')) {
                $table->dropForeign('332948_5d4df9df2988e');
                $table->dropIndex('332948_5d4df9df2988e');
                $table->dropColumn('daily_challenge_id');
            }
            
        });
    }
}
