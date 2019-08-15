<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1565371259DescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descriptions', function (Blueprint $table) {
            if(Schema::hasColumn('descriptions', 'courses_id')) {
                $table->dropForeign('319112_5d13e8de1e0e5');
                $table->dropIndex('319112_5d13e8de1e0e5');
                $table->dropColumn('courses_id');
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
                        
        });

    }
}
