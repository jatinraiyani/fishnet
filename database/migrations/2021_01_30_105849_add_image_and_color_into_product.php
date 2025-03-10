<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageAndColorIntoProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product',function(Blueprint $table){
            $table->string('image')->nullable()->after('description');
            $table->string('color')->nullable()->after('image');
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
            $table->dropColumn('image');
            $table->dropColumn('color');
        });
    }
}
