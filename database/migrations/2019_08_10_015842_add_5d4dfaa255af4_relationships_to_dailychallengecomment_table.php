<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d4dfaa255af4RelationshipsToDailyChallengeCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_challenge_comments', function(Blueprint $table) {
            if (!Schema::hasColumn('daily_challenge_comments', 'daily_challenge_id')) {
                $table->integer('daily_challenge_id')->unsigned()->nullable();
                $table->foreign('daily_challenge_id', '332949_5d4dfa9dae4e9')->references('id')->on('daily_challenges')->onDelete('cascade');
                }
                if (!Schema::hasColumn('daily_challenge_comments', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '332949_5d4dfa9dc949f')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('daily_challenge_comments', function(Blueprint $table) {
            
        });
    }
}
