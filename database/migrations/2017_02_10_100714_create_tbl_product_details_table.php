<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->string('product_knotcnt')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_width')->nullable();
            $table->string('product_repeat')->nullable();
            $table->string('product_images')->nullable();
            $table->integer('product_order')->nullable();
            $table->integer('product_status')->nullable();
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
        Schema::dropIfExists('tbl_product_details');
    }
}
