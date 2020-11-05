<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class LaravelUpgradeUpdatePolymorphicRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('links')) {
            DB::table('links')->where('linkable_type','App\User')->update(['linkable_type' => 'App\Models\User']);
            DB::table('links')->where('linkable_type','App\Entity')->update(['linkable_type' => 'App\Models\Entity']);
        }
        if (Schema::hasTable('profile_pictures')) {
            DB::table('profile_pictures')->where('profileable_type','App\User')->update(['profileable_type' => 'App\Models\User']);
            DB::table('profile_pictures')->where('profileable_type','App\Entity')->update(['profileable_type' => 'App\Models\Entity']);
        }
        if (Schema::hasTable('photos')) {
            DB::table('photos')->where('photoable_type','App\User')->update(['photoable_type' => 'App\Models\User']);
            DB::table('photos')->where('photoable_type','App\Entity')->update(['photoable_type' => 'App\Models\Entity']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('links')){
            DB::table('links')->where('linkable_type','App\Models\User')->update(['linkable_type' => 'App\User']);
            DB::table('links')->where('linkable_type','App\Models\Entity')->update(['linkable_type' => 'App\Entity']);
        }
        if (Schema::hasTable('profile_pictures')) {
            DB::table('profile_pictures')->where('profileable_type','App\Models\User')->update(['profileable_type' => 'App\User']);
            DB::table('profile_pictures')->where('profileable_type','App\Models\Entity')->update(['profileable_type' => 'App\Entity']);
        }
        if (Schema::hasTable('photos')) {
            DB::table('photos')->where('photoable_type','App\Models\User')->update(['photoable_type' => 'App\User']);
            DB::table('photos')->where('photoable_type','App\Models\Entity')->update(['photoable_type' => 'App\Entity']);
        }
    }
}
