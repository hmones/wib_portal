<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveFieldToUsersPostsComments extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->after('id')->default(1)->index();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->boolean('active')->after('id')->default(1)->index();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('active')->after('id')->default(1)->index();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
