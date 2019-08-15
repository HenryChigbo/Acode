<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1565392294DailyChallengeCommentFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('daily_challenge_comment_flags')) {
            Schema::create('daily_challenge_comment_flags', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('counter')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_challenge_comment_flags');
    }
}
