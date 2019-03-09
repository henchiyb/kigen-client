<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('farm_images');
        Schema::create('farm_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('farm_id')->unsigned();
            $table->string('img_link');
            $table->timestamps();
        });
        // Schema::table('farm_images', function($table) {
        //     $table->foreign('farm_id')->references('id')->on('farms');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_images');
    }
}
