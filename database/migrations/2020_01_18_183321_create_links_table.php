<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
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
            $table->bigInteger('entity_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->boolean('verified')->default(False);
            $table->bigInteger('verified_by')->unsigned()->index();
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('supported_links');
            $table->foreign('entity_id')->references('id')->on('entities');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('verified_by')->references('id')->on('admin_users');
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
            $table->dropForeign(['user_id']);
            $table->dropForeign(['entity_id']);
            $table->dropForeign(['verified_by']);
        });
        Schema::dropIfExists('links');
    }
}
