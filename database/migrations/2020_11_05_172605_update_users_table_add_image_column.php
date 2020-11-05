<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableAddImageColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->after('email')->nullable();
        });
        if (Schema::hasTable('profile_pictures')) {
            $records = DB::table('profile_pictures')->where('profileable_type','App\Models\User')->where('resolution','300')->get();
            foreach ($records as $record) {
                DB::table('users')->where('id', $record->profileable_id)->update(['image' => $record->url]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
