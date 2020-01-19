<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('link', 255);
            $table->bigInteger('type_id')->unsigned()->index();
            $table->boolean('verified')->default(False);
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('supported_links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('links', function ($table){
            $table->dropForeign(['type_id']);
        });
        Schema::dropIfExists('links');
    }
}
