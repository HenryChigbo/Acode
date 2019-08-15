<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d529f5861173RelationshipsToCourseIntroductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_introductions', function(Blueprint $table) {
            if (!Schema::hasColumn('course_introductions', 'course_key_id')) {
                $table->integer('course_key_id')->unsigned()->nullable();
                $table->foreign('course_key_id', '333767_5d529f5392ac1')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::table('course_introductions', function(Blueprint $table) {
            
        });
    }
}
