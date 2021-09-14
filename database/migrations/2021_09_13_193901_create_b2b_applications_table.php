<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateB2bApplicationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('b2b_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('round_id');
            $table->bigInteger('user_id');
            $table->string('type')->nullable();
            $table->bigInteger('entity_id')->nullable();
            $table->json('data')->nullable();
            $table->string('status')->default('submitted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('b2b_applications');
    }
}
