<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nhomsanphamid')->unsigned();
            $table->string('ten',255);
            $table->text('mota')->nullable();
            $table->float('gia',15,3);
            $table->float('giaban',15,3)->nullable();
            $table->string('anh', 255)->nullable();
            $table->string('danhsachanh', 500)->nullable();
            $table->tinyInteger('trangthai')->default(1)->comment('1-public, 0-private');
            $table->tinyInteger('uutien')->default(0)->comment('Thu tu uu tien');
            $table->timestamps();
            $table->foreign('nhomsanphamid')->references('id')->on('nhomsanpham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
}
