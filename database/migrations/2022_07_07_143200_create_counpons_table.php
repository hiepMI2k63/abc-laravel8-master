<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counpons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type',['fixed','percent']);
            $table->decimal('value');
            $table->decimal('cart_value');
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
        Schema::dropIfExists('counpons');
    }
}
