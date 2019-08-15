<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1565373247LessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            if(Schema::hasColumn('lessons', 'platform')) {
                $table->dropColumn('platform');
            }
            if(Schema::hasColumn('lessons', 'level')) {
                $table->dropColumn('level');
            }
            if(Schema::hasColumn('lessons', 'topic')) {
                $table->dropColumn('topic');
            }
            if(Schema::hasColumn('lessons', 'content')) {
                $table->dropColumn('content');
            }
            
        });
Schema::table('lessons', function (Blueprint $table) {
            
if (!Schema::hasColumn('lessons', 'name')) {
                $table->string('name')->nullable();
                }
if (!Schema::hasColumn('lessons', 'description')) {
                $table->string('description')->nullable();
                }
if (!Schema::hasColumn('lessons', 'content')) {
                $table->string('content')->nullable();
                }
if (!Schema::hasColumn('lessons', 'prerequisite')) {
                $table->string('prerequisite')->nullable();
                }
if (!Schema::hasColumn('lessons', 'avatar')) {
                $table->string('avatar')->nullable();
                }
if (!Schema::hasColumn('lessons', 'color_background')) {
                $table->string('color_background')->nullable();
                }
if (!Schema::hasColumn('lessons', 'color_foreground')) {
                $table->string('color_foreground')->nullable();
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
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('content');
            $table->dropColumn('prerequisite');
            $table->dropColumn('avatar');
            $table->dropColumn('color_background');
            $table->dropColumn('color_foreground');
            
        });
Schema::table('lessons', function (Blueprint $table) {
                        $table->string('platform')->nullable();
                $table->string('level')->nullable();
                $table->string('topic')->nullable();
                $table->string('content')->nullable();
                
        });

    }
}
