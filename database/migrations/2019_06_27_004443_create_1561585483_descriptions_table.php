<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561585483DescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('descriptions')) {
            Schema::create('descriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('courseid')->nullable();
                $table->string('content')->nullable();
                $table->tinyInteger('visible')->nullable()->default('0');
                
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
        Schema::dropIfExists('descriptions');
    }
}
