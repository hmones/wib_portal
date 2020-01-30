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
            $table->string('url');
            $table->unsignedBigInteger('type_id')->index();
            $table->unsignedBigInteger('linkable_id')->index();
            $table->string('linkable_type')->index();
            $table->timestamp('verified_at')->nullable();
            $table->bigInteger('verified_by')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('supported_links');
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
            $table->dropForeign(['verified_by']);
        });
        Schema::dropIfExists('links');
    }
}
