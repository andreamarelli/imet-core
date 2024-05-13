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
        Schema::create('imet_metadata_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->char('version', 2)->nullable();
            $table->string('code', 10)->nullable();
            $table->string('code_label', 15)->nullable();
            $table->text('title_fr')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_sp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imet_metadata_statistics');
    }
};
