<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('title',20)->after('id')->nullable();
            $table->char('gender',30)->default('Female');
            $table->unsignedSmallInteger('birth_year')->default(1960);
            $table->longText('bio')->nullable();
            $table->unsignedSmallInteger('phone_country_code')->nullable();
            $table->char('phone',20)->nullable();
            $table->char('postal_code',50)->nullable();
            $table->bigInteger('city_id')->unsigned()->index()->nullable();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->char('sphere',255)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->char('education',255)->nullable();
            $table->boolean('mena_diaspora')->default(False);
            $table->char('network',3)->default('WIB');
            $table->char('business_association_wom',30)->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->bigInteger('approved_by')->unsigned()->index()->nullable();
            $table->boolean('premium')->default(False);
            $table->boolean('sponsor')->default(False);
            $table->boolean('newsletter')->default(False);
            $table->timestamp('newsletter_date')->nullable();
            $table->boolean('gdpr_consent')->default(False);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'title',
                'gender',
                'birth_year',
                'bio',
                'phone_country_code',
                'phone',
                'postal_code',
                'city_id',
                'country_id',
                'sphere',
                'last_login',
                'education',
                'mena_diaspora',
                'network',
                'business_association_wom',
                'approved',
                'approved_by',
                'premium',
                'sponsor',
                'newsletter',
                'newsletter_date',
                'gdpr_consent'
            ]);
        });
    }
}

