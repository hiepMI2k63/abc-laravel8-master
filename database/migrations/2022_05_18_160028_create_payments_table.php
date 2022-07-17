<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->string('code_vnpay')->comment('code giao dịch vnp');
            $table->string('code_bank')->comment('code giao dịch ngân hàng');
            $table->string('typecard')->comment('loại thẻ');
            $table->string('vnp_response_code')->comment('mã phản hồi');
            $table->string('note')->comment('thông tin thanh toán');
            $table->float('amount')->comment(' số tiền thanh toán');
            $table->bigInteger('TransactionNo')->comment('mã số giao dịch');
            $table->bigInteger('TransactionStatus')->comment('1: thành công, 2:thất bại');
            $table->tinyInteger('type')->comment('1: trực tiếp, 2: online')->default(2);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
