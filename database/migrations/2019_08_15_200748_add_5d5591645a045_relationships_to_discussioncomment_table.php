<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d5591645a045RelationshipsToDiscussionCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussion_comments', function(Blueprint $table) {
            if (!Schema::hasColumn('discussion_comments', 'discussion_id')) {
                $table->integer('discussion_id')->unsigned()->nullable();
                $table->foreign('discussion_id', '332962_5d4e055b01468')->references('id')->on('discussions')->onDelete('cascade');
                }
                if (!Schema::hasColumn('discussion_comments', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '332962_5d4e055b26ae2')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('discussion_comments', function(Blueprint $table) {
            
        });
    }
}
