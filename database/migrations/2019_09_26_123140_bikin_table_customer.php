<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BikinTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function(blueprint $table){
            $table->uuid('id_customer')->primary();
            $table->string('kode_customer', 100);
            $table->string('nama_customer',155);
            $table->string('telepon_customer',100);
            $table->longText('alamat_customer');
            $table->string('kelurahan_customer',100)->nullable();
            $table->string('kecamatan_customer',100)->nullable();
            $table->string('kota_customer',100)->nullable();
            $table->integer('kodepos_customer')->nullable();
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
        Schema::dropIfExists('customer');
    }
}
