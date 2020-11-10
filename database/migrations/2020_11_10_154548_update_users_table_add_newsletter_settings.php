<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableAddNewsletterSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notify_comment')->default(1)->index();
            $table->boolean('notify_message')->default(1)->index();
            $table->boolean('notify_post')->default(1)->index();
            $table->boolean('notify_user')->default(1)->index();
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
            $table->dropColumn('notify_comment');
            $table->dropColumn('notify_message');
            $table->dropColumn('notify_post');
            $table->dropColumn('notify_user');
        });
    }
}
