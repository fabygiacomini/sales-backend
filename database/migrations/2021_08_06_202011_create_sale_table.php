<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');
            $table->integer('seller_id')->nullable(false);
            $table->decimal('sale_value', 8, 2)->nullable(false);
            $table->decimal('sale_commission', 8, 2)->nullable(true);
            $table->timestamp('sale_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale');
    }
}
