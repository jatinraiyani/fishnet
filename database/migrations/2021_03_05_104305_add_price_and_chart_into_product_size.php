<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceAndChartIntoProductSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_size',function(Blueprint $table){
            $table->string('price')->nullable()->after('weight');
            $table->string('chart')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_size',function(Blueprint $table){
            $table->dropColumn('price');
            $table->dropColumn('chart');
        });
    }
}
