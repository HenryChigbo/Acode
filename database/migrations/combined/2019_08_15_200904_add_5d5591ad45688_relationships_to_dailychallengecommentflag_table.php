<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d5591ad45688RelationshipsToDailyChallengeCommentFlagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_challenge_comment_flags', function(Blueprint $table) {
            if (!Schema::hasColumn('daily_challenge_comment_flags', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '332950_5d4dfdab72e81')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('daily_challenge_comment_flags', 'daily_challenge_comment_id')) {
                $table->integer('daily_challenge_comment_id')->unsigned()->nullable();
                $table->foreign('daily_challenge_comment_id', '332950_5d4dfdab8fa9a')->references('id')->on('daily_challenge_comments')->onDelete('cascade');
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
        Schema::table('daily_challenge_comment_flags', function(Blueprint $table) {
            if(Schema::hasColumn('daily_challenge_comment_flags', 'user_id')) {
                $table->dropForeign('332950_5d4dfdab72e81');
                $table->dropIndex('332950_5d4dfdab72e81');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('daily_challenge_comment_flags', 'daily_challenge_comment_id')) {
                $table->dropForeign('332950_5d4dfdab8fa9a');
                $table->dropIndex('332950_5d4dfdab8fa9a');
                $table->dropColumn('daily_challenge_comment_id');
            }
            
        });
    }
}
