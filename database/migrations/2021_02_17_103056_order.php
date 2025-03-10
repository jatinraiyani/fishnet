<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('ordernumber');
            $table->double('subtotal');
            $table->double('tax');
            $table->double('delivery_charge');
            $table->double('discount');
            $table->string('promo');
            $table->double('grand_total');
            $table->longText('note')->nullable();
            $table->bigInteger('address');
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->enum('order_status',['pending_for_call','ready_for_pay','pending','confirm','onway','cancel','success','slip_refuse']);
            $table->longText('cancel_reason')->nullable();
            $table->enum('payment_status',['pending','success','failed']);
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
        Schema::dropIfExists('order');
    }
}
