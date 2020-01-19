<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_link', function (Blueprint $table) {
            $table->bigInteger('entity_id')->unsigned()->index();
            $table->bigInteger('link_id')->unsigned()->index();
            $table->foreign('entity_id')->references('id')->on('entities')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('link_id')->references('id')->on('links')
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
        Schema::table('entity_link', function ($table){
            $table->dropForeign(['entity_id']);
            $table->dropForeign(['link_id']);
        });
        Schema::dropIfExists('entity_link');
    }
}
