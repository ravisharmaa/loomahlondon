<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblColourwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_colourways', function (Blueprint $table) {
            $table->increments('colourway_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->string('colourway_name',100)->nuallable();
            $table->string('colourway_alias',100)->nullable();
            $table->string('colourway_description')->nullable();
            $table->string('colourway_th_image')->nullable();
            $table->string('colourway_lg_image')->nullable();
            $table->boolean('colourway_default')->default('1');
            $table->integer('colourway_order')->nullable();
            $table->boolean('colourway_status')->nullable();
            $table->foreign('product_id')->references('product_id')->on('tbl_products')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_colourways');
    }
}
