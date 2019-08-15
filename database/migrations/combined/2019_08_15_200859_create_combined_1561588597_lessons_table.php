<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1561588597LessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('lessons')) {
            Schema::create('lessons', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('description')->nullable();
                $table->string('content')->nullable();
                $table->string('prerequisite')->nullable();
                $table->string('avatar')->nullable();
                $table->string('color_background')->nullable();
                $table->string('color_foreground')->nullable();
                
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
        Schema::dropIfExists('lessons');
    }
}
