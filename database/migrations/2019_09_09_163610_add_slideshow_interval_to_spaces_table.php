<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlideshowIntervalToSpacesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->unsignedInteger('slideshow_interval')->nullable()->after('theme');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropColumn('slideshow_interval');
        });
    }
}
