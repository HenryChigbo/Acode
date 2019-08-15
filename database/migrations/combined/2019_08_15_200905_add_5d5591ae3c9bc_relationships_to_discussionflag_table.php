<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d5591ae3c9bcRelationshipsToDiscussionFlagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussion_flags', function(Blueprint $table) {
            if (!Schema::hasColumn('discussion_flags', 'discussion_id')) {
                $table->integer('discussion_id')->unsigned()->nullable();
                $table->foreign('discussion_id', '332960_5d4e04aeb55a1')->references('id')->on('discussions')->onDelete('cascade');
                }
                if (!Schema::hasColumn('discussion_flags', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '332960_5d4e04aecff39')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('discussion_flags', function(Blueprint $table) {
            if(Schema::hasColumn('discussion_flags', 'discussion_id')) {
                $table->dropForeign('332960_5d4e04aeb55a1');
                $table->dropIndex('332960_5d4e04aeb55a1');
                $table->dropColumn('discussion_id');
            }
            if(Schema::hasColumn('discussion_flags', 'user_id')) {
                $table->dropForeign('332960_5d4e04aecff39');
                $table->dropIndex('332960_5d4e04aecff39');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
