<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BikinTabelEcommerce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce', function(Blueprint $table){
            $table->uuid('id_ecommerce')->primary();
            $table->string('kode_ecommerce',100);
            $table->string('nama_ecommerce', 100);
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
        Schema::dropIfExists('ecommerce');
    }
}
