<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('product_id');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            // $table->text('address')->nullable();
            $table->tinyInteger('rating')->nullable(); // 1-5
            // $table->tinyInteger('gender')->default(0)->comment('0: Nam, 1: Nữ'); // 0-1
            $table->tinyInteger('count_quality')->default(0); // 1-5
            $table->tinyInteger('count_worth')->default(0); // 1-5
            $table->integer('count_like')->default(0);
            $table->integer('count_dislike')->default(0);
            $table->dateTime('publish_at')->nullable();
            $table->text('file')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
