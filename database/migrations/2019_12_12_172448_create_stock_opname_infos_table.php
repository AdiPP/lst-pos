<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpnameInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opname_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stok_opname_id');
            $table->unsignedBigInteger('product_id');
            $table->bigInteger('jumlah_aktual');
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
        Schema::dropIfExists('stock_opname_infos');
    }
}
