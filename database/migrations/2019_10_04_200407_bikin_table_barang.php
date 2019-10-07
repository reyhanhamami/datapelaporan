<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BikinTableBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function(blueprint $table){
            $table->uuid('id_barang')->primary();
            $table->string('nama_barang', 200);
            $table->string('foto_barang', 255);
            $table->string('stock_barang',255);
            $table->string('kategori_barang',255);
            $table->string('harga_jual',255);
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
        Schema::dropIfExists('barang');
    }
}
