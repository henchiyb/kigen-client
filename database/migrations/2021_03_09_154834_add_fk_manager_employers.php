<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkManagerEmployers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manager_employers', function(Blueprint $table){
            $table->foreign('manager_id')->references('id')->on('user');
            $table->foreign('employer_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('product_images', function(Blueprint $table){
        //     $table->dropForeign('product_id');
        //     $table->dropColumn('product_id');
        // });
    }
}
