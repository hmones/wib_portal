<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitySearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_search', function (Blueprint $table) {
            $table->bigInteger('entity_id')->unsigned()->index();
            $table->bigInteger('search_id')->unsigned()->index();
            $table->foreign('entity_id')->references('id')->on('entities')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('search_id')->references('id')->on('searching_for_options')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity_search', function ($table){
            $table->dropForeign(['entity_id']);
            $table->dropForeign(['search_id']);
        });
        Schema::dropIfExists('entity_search');
    }
}
