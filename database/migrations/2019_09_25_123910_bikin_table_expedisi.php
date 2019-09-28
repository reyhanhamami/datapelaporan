<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BikinTableExpedisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedisi', function(blueprint $table){
            $table->uuid('id_expedisi')->primary();
            $table->string('kode_expedisi',100);
            $table->string('nama_expedisi', 100);
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
        Schema::dropIfExists('expedisi');
    }
}
