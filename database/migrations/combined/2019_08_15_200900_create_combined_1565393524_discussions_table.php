<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1565393524DiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('discussions')) {
            Schema::create('discussions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('question')->nullable();
                $table->enum('tags', array('Android', 'iOS', 'Flutter', 'React Native', 'Xamarin'))->nullable();
                $table->string('description')->nullable();
                $table->string('post')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
