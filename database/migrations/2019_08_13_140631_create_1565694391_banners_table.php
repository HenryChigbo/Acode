<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1565694391BannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('banners')) {
            Schema::create('banners', function (Blueprint $table) {
                $table->increments('id');
                $table->string('photo_one')->nullable();
                $table->string('photo_two')->nullable();
                $table->string('photo_three')->nullable();
                $table->string('photo_four')->nullable();
                
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
        Schema::dropIfExists('banners');
    }
}
