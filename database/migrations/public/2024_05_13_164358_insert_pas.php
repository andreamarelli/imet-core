<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fields = ['country, wdpa_id, name, iucn_category, area, global_id'];
        $records = [

        ];

        foreach ($records as $record) {
            DB::table('imet_pas')
                ->insert(array_combine($fields, $record));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('imet_pas')->truncate();
    }
};
