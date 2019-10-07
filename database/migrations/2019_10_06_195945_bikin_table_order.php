<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BikinTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function(blueprint $table){
            $table->string('id_order', 155)->primary();
            $table->date('tanggal_order');
            $table->string('reseller_order',155);
            $table->string('pengirim_order',255)->nullable();
            $table->string('ecommerce_order',255);
            $table->string('barang_order',255);
            $table->string('note_order',255);
            $table->string('beliberapa_order',255);
            $table->string('expedisi_order',255);
            $table->string('ongkir_order',255);
            $table->string('total_order',255);
            $table->string('customer_order',255);
            $table->string('resiotomatis_order',255);
            $table->string('drop_order',255);
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
