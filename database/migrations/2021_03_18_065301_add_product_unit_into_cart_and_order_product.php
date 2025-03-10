<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductUnitIntoCartAndOrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart',function(Blueprint $table){
            $table->string('product_unit')->nullable()->after('type');            
        });

        Schema::table('order_product',function(Blueprint $table){
            $table->string('product_unit')->nullable()->after('product_name');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart',function(Blueprint $table){
            $table->dropColumn('product_unit');            
        });

        Schema::table('order_product',function(Blueprint $table){
            $table->dropColumn('product_unit');            
        });
    }
}
