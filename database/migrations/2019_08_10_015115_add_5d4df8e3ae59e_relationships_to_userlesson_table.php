<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d4df8e3ae59eRelationshipsToUserLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_lessons', function(Blueprint $table) {
            if (!Schema::hasColumn('user_lessons', 'users_id')) {
                $table->integer('users_id')->unsigned()->nullable();
                $table->foreign('users_id', '332925_5d4db5b01522c')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('user_lessons', 'lesson_id')) {
                $table->integer('lesson_id')->unsigned()->nullable();
                $table->foreign('lesson_id', '332925_5d4db5b040b7b')->references('id')->on('lessons')->onDelete('cascade');
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
        Schema::table('user_lessons', function(Blueprint $table) {
            
        });
    }
}
