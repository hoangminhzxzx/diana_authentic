<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_master', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->default('');
            $table->string('customer_phone')->default('');
            $table->text('address')->default('');
            $table->string('email')->default('');
            $table->text('note')->default('');
            $table->integer('status')->default(1)->comment('1 : đặt hàng, 2 : hoàn thành , 3 : hủy');
            $table->integer('total_price')->default(0)->comment('Tổng giá trị đơn hàng');
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
        Schema::dropIfExists('order_master');
    }
}
