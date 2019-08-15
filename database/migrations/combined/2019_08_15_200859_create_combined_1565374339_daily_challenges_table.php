<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1565374339DailyChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('daily_challenges')) {
            Schema::create('daily_challenges', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('description')->nullable();
                $table->string('image')->nullable();
                
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
        Schema::dropIfExists('daily_challenges');
    }
}
