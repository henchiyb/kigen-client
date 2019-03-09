<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product_packages');
        Schema::create('product_packages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned();
            $table->integer('farm_id')->unsigned();
            $table->string('status');
            $table->string('img_link');
            $table->timestamps();
        });
        // Schema::table('product_packages', function($table) {
        //     $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_packages');
    }
}
