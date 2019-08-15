<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1561585885DescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descriptions', function (Blueprint $table) {
            if(Schema::hasColumn('descriptions', 'courseid')) {
                $table->dropColumn('courseid');
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
        Schema::table('descriptions', function (Blueprint $table) {
                        $table->integer('courseid')->nullable();
                
        });

    }
}
