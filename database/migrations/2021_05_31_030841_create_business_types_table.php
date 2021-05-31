<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branch');
            $table->bigInteger('unbearbeitet');
            $table->bigInteger('gf_fehit');
            $table->bigInteger('nicht_erreicht');
            $table->bigInteger('weidervorlage');
            $table->bigInteger('kein_interesse');
            $table->bigInteger('zu_viele_versuche');
            $table->bigInteger('termine');
            $table->bigInteger('kunden');
            $table->bigInteger('blacklist');
            $table->bigInteger('insgesamt');
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
        Schema::dropIfExists('business_types');
    }
}
