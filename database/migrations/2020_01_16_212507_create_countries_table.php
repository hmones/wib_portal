<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 255)->index();
            $table->char('code',25)->index();
            $table->char('code_long',25)->index();
            $table->bigInteger('country_iso_code')->unsigned()->index();
            $table->unsignedSmallInteger('calling_code');
            $table->char('continent',25);
            $table->boolean('mena')->default(True);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
