<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateDataUsersEntities extends Migration
{
    public function up(): void
    {
        $entities = DB::table('entities')->whereNotNull('owned_by')->get();

        foreach ($entities as $entity) {
            if (DB::table('users')->where('id', $entity->owned_by)->first()) {
                DB::table('user_entity')->updateOrInsert(
                    ['user_id' => $entity->owned_by, 'entity_id' => $entity->id],
                    ['relation_type' => 'Owner', 'relation_active' => 1, 'relation_date' => now()]
                );
            }
        }
    }

    public function down(): void
    {
        //
    }
}
