<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d5591abcca5dRelationshipsToDiscussionViewerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussion_viewers', function(Blueprint $table) {
            if (!Schema::hasColumn('discussion_viewers', 'discussion_id')) {
                $table->integer('discussion_id')->unsigned()->nullable();
                $table->foreign('discussion_id', '332963_5d4e05f56b819')->references('id')->on('discussions')->onDelete('cascade');
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
        Schema::table('discussion_viewers', function(Blueprint $table) {
            
        });
    }
}
