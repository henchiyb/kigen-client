<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_employers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('manager_id');
            $table->integer('employer_id');
            $table->timestamps();
        });
        // Schema::table('manager_employers', function(Blueprint $table){
        //     $table->foreign('manager_id')->references('id')->on('managers');
        //     $table->foreign('employer_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_employers');
    }
}
