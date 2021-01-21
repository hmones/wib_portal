<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateEntitiesTableAddImageColumn extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->string('image')->after('name_additional')->nullable();
        });
        if (Schema::hasTable('profile_pictures')) {
            $records = DB::table('profile_pictures')->where('profileable_type','App\Models\Entity')->where('resolution','300')->get();
            foreach ($records as $record) {
                DB::table('entities')->where('id', $record->profileable_id)->update(['image' => $record->url]);
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
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
