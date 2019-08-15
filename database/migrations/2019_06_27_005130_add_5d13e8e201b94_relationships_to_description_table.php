<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d13e8e201b94RelationshipsToDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descriptions', function(Blueprint $table) {
            if (!Schema::hasColumn('descriptions', 'courses_id')) {
                $table->integer('courses_id')->unsigned()->nullable();
                $table->foreign('courses_id', '319112_5d13e8de1e0e5')->references('id')->on('descriptions')->onDelete('cascade');
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
        Schema::table('descriptions', function(Blueprint $table) {
            
        });
    }
}
