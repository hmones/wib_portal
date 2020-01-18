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
            $table->char('name',255);
            $table->char('name_additional',255)->nullable();
            $table->integer('entity_type');
            $table->unsignedSmallInteger('founding_year');
            $table->char('primary_address',100)->nullable();
            $table->char('primary_postbox',100)->nullable();
            $table->char('primary_postal_code',50)->nullable();
            $table->char('primary_state',150)->nullable();
            $table->integer('primary_city_id');
            $table->integer('primary_country_id');
            $table->char('secondary_address',100)->nullable();
            $table->char('secondary_postbox',100)->nullable();
            $table->char('secondary_postal_code',50)->nullable();
            $table->char('secondary_state',150)->nullable();
            $table->integer('secondary_city_id');
            $table->integer('secondary_country_id');
            $table->char('primary_email',255);
            $table->char('secondary_email',255);
            $table->unsignedSmallInteger('phone_country_code')->nullable();
            $table->char('phone',20)->nullable();
            $table->char('fax',20)->nullable();
            $table->char('legal_form',20);
            $table->char('activity', 20);
            $table->char('network', 3);
            $table->char('entity_size', 50);
            $table->char('turn_over', 50);
            $table->char('balance_sheet', 50);
            $table->char('revenue', 50);
            $table->char('employees', 50);
            $table->char('students', 50);
            $table->char('business_type', 50);
            $table->boolean('approved')->default(False);
            $table->unsignedBigInteger('approved_by');
            $table->timestamps();
            $table->primary('id');
            $table->index(['name','name_additional', 'founding_year','primary_city_id','primary_country_id','secondary_city_id', 'secondary_country_id']);
            $table->foreign('primary_city_id')->references('id')->on('cities');
            $table->foreign('primary_country_id')->references('id')->on('countries');
            $table->foreign('secondary_city_id')->references('id')->on('cities');
            $table->foreign('secondary_country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}
