<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockStatusIntoProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product',function(Blueprint $table){
            $table->bigInteger('category_id')->nullable()->change();
            $table->enum('stock_status',['available','out_of_stock','few_available','pre_order'])->default('available'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product',function(Blueprint $table){
            $table->dropColumn('category_id');
            $table->dropColumn('stock_status',['available','out_of_stock','few_available']); 
        });
    }
}