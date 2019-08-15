<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1561757816UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users', 'location_address')) {
                $table->dropColumn('location_address');
                $table->dropColumn('location_latitude');
                $table->dropColumn('location_longitude');
            }
            
        });
Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'country')) {
                $table->string('country')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            
        });
Schema::table('users', function (Blueprint $table) {
                        $table->string('location_address')->nullable();
                $table->double('location_latitude')->nullable();
                $table->double('location_longitude')->nullable();
                
        });

    }
}
