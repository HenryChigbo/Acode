<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d4dfdb006e66RelationshipsToDailyChallengeCommentFlagTable extends Migration
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
                $table->foreign('user_id', '332950_5d4dfdab72e81')->references('id')->on('daily_challenge_comments')->onDelete('cascade');
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
            
        });
    }
}
