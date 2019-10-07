<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BikinTableVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function(blueprint $table){
            $table->uuid('id_vendor')->primary();
            $table->string('nama_vendor',150);
            $table->string('telepon_vendor',100);
            $table->longText('alamat_vendor');
            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->integer('harga_jual');
            $table->integer('harga_beli');
            $table->string('from');
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
        Schema::dropIfExists('vendor');
    }
}
