<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5d4dab86ad2d1DescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('descriptions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('descriptions')) {
            Schema::create('descriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('content')->nullable();
                $table->tinyInteger('visible')->nullable()->default('0');
                
                $table->timestamps();
                $table->softDeletes();

            $table->index(['deleted_at']);
            });
        }
    }
}
