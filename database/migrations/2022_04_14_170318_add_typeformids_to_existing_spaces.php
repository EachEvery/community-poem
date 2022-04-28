<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeformidsToExistingSpaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('spaces')->get()->each(function($rowSpace) {
            DB::table('typeform_ids')->insert([
                'space_id' => $rowSpace->id,
                'typeform_id' => $rowSpace->typeform_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // php artisan migrate:rollback
    public function down()
    {
        DB::table('typeform_ids')->truncate();
    }
}
