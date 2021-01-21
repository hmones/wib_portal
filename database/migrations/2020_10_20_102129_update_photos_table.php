<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->text('comment')->nullable()->after('filename');
            $table->unsignedBigInteger('photoable_id')->nullable()->change();
            $table->string('photoable_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->unsignedBigInteger('photoable_id')->nullable(false)->change();
            $table->string('photoable_type')->nullable(false)->change();
        });
    }
}
