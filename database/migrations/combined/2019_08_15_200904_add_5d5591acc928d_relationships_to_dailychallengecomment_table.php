<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d5591acc928dRelationshipsToDailyChallengeCommentTable extends Migration
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
            if(Schema::hasColumn('daily_challenge_comments', 'daily_challenge_id')) {
                $table->dropForeign('332949_5d4dfa9dae4e9');
                $table->dropIndex('332949_5d4dfa9dae4e9');
                $table->dropColumn('daily_challenge_id');
            }
            if(Schema::hasColumn('daily_challenge_comments', 'user_id')) {
                $table->dropForeign('332949_5d4dfa9dc949f');
                $table->dropIndex('332949_5d4dfa9dc949f');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
