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
            $table->char('gender',30);
            $table->unsignedSmallInteger('birth_year');
            $table->longText('bio')->nullable();
            $table->unsignedSmallInteger('phone_country_code')->nullable();
            $table->char('phone',20)->nullable();
            $table->char('postal_code',50)->nullable();
            $table->char('state',150)->nullable();
            $table->integer('city_id');
            $table->integer('country_id');
            $table->char('activity',255);
            $table->char('sphere',255);
            $table->char('education',255);
            $table->boolean('mena_diaspora')->default(False);
            $table->char('network',3)->default('WIB');
            $table->char('business_association_wom',30)->nullable();
            $table->boolean('approved')->default(False);
            $table->unsignedBigInteger('approved_by');
            $table->boolean('premium')->default(False);
            $table->boolean('sponsor')->default(False);
            $table->boolean('newsletter')->default(False);
            $table->dateTime('newsletter_date',30)->nullable();
            $table->boolean('gdpr_consent')->default(False);
            $table->index(['country_id','city_id']);
            $table->primary('id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('approved_by')->references('id')->on('admin_users');
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
            $table->dropColumn([
                'title', 'gender', 'birth_year', 'bio','phone_country_code','phone','postal_code','state','city_id',
                'country_id','activity','sphere','education','mena_diaspora','network','business_association_wom',
                'active','premium','sponsor','newsletter','newsletter_date','gdpr_consent'
            ]);
            $table->dropIndex(['country_id','city_id']);
        });
    }
}
