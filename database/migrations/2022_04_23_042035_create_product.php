<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('rating')->default(0);
            $table->string('price')->default(0);
            $table->string('sale_price')->default(0);
            $table->string('sale_percent');
            $table->integer('company');
            $table->integer('product_type');
            $table->integer('product_line');
            $table->integer('price_type');
            $table->integer('shape_type');
            $table->integer('technology_type');
            $table->integer('reliability_type');
            $table->longText('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('product');
    }
}
