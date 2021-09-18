<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoundsTable extends Migration
{
    public function up(): void
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->text('text_providers')->nullable();
            $table->renameColumn('description', 'text_application');
        });
    }

    public function down(): void
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->dropColumn('text_providers');
            $table->renameColumn('text_application', 'description');
        });
    }
}
