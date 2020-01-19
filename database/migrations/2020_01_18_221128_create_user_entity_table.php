<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_entity', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('entity_id')->unsigned()->index();
            $table->char('relation_type',255);
            $table->char('relation_desc',255);
            $table->boolean('relation_active');
            $table->dateTime('relation_date');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entity_id')->references('id')->on('entities')
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
        Schema::table('user_entity', function ($table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['entity_id']);
        });
        Schema::dropIfExists('user_entity');
    }
}
