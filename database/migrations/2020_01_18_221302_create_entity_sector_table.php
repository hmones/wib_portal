<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitySectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_sector', function (Blueprint $table) {
            $table->bigInteger('entity_id')->unsigned()->index();
            $table->bigInteger('sector_id')->unsigned()->index();
            $table->foreign('entity_id')->references('id')->on('entities')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')
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
        Schema::table('entity_sector', function ($table){
            $table->dropForeign(['entity_id']);
            $table->dropForeign(['sector_id']);
        });
        Schema::dropIfExists('entity_sector');
    }
}
