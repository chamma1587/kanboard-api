<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->bigIncrements('id');              
            $table->string('uuid', 45);                          
            $table->string('title', 191);                          
            $table->nullableTimestamps();
        });


        Schema::create('board_items', function (Blueprint $table) {
            $table->bigIncrements('id');              
            $table->string('uuid', 45);                          
            $table->unsignedBigInteger('board_id');                           
            $table->string('title', 191);   
            $table->text('description');             
            $table->nullableTimestamps();

            $table->foreign('board_id')->references('id')->on('boards');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('board_items', function (Blueprint $table) {   
            $table->dropForeign(['board_id']);
        });

        Schema::dropIfExists('board_items');
        Schema::dropIfExists('boards');
    }
}
