<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name',255)->index();
            $table->char('name_additional',255)->nullable()->index();
            $table->bigInteger('entity_type_id')->unsigned()->index();
            $table->unsignedSmallInteger('founding_year')->index()->nullable();
            $table->char('primary_address',100)->nullable();
            $table->char('primary_postbox',100)->nullable();
            $table->char('primary_postal_code',50)->nullable();;
            $table->bigInteger('primary_city_id')->unsigned()->index();
            $table->bigInteger('primary_country_id')->unsigned()->index();
            $table->char('secondary_address',100)->nullable();
            $table->char('secondary_postbox',100)->nullable();
            $table->char('secondary_postal_code',50)->nullable();
            $table->bigInteger('secondary_city_id')->unsigned()->index()->nullable();
            $table->bigInteger('secondary_country_id')->unsigned()->index()->nullable();
            $table->char('primary_email',255);
            $table->char('secondary_email',255)->nullable();
            $table->unsignedSmallInteger('phone_country_code')->nullable();
            $table->char('phone',20)->nullable();
            $table->char('fax',20)->nullable();
            $table->char('legal_form',20)->nullable();
            $table->char('activity', 20)->nullable();
            $table->char('network', 3);
            $table->char('entity_size', 50)->nullable();
            $table->char('turn_over', 50)->nullable();
            $table->char('balance_sheet', 50)->nullable();
            $table->char('revenue', 50)->nullable();
            $table->char('employees', 50)->nullable();
            $table->char('students', 50)->nullable();
            $table->char('business_type', 50)->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->bigInteger('approved_by')->unsigned()->nullable()->index();
            $table->unsignedBigInteger('owned_by')->nullable()->index();
            $table->timestamps();
            $table->foreign('primary_city_id')->references('id')->on('cities');
            $table->foreign('primary_country_id')->references('id')->on('countries');
            $table->foreign('secondary_city_id')->references('id')->on('cities');
            $table->foreign('secondary_country_id')->references('id')->on('countries');
            $table->foreign('entity_type_id')->references('id')->on('entity_types');
            $table->foreign('approved_by')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entities', function ($table){
            $table->dropForeign(['primary_city_id']);
            $table->dropForeign(['primary_country_id']);
            $table->dropForeign(['secondary_city_id']);
            $table->dropForeign(['secondary_country_id']);
            $table->dropForeign(['entity_type_id']);
            $table->dropForeign(['approved_by']);

        });
        Schema::dropIfExists('entities');
    }
}
