<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imet_regions', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->text('name')->nullable();
            $table->text('name_fr')->nullable();
            $table->text('name_sp')->nullable();
            $table->text('name_pt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imet_regions');
    }
};
