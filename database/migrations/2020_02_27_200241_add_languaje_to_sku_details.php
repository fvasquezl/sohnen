<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLanguajeToSkuDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('SKUDetails', function (Blueprint $table) {
            $table->foreign('LanguajeID')->references('LanguajeID')->on('Languajes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('SKUDetails', function (Blueprint $table) {
            //
        });
    }
}
