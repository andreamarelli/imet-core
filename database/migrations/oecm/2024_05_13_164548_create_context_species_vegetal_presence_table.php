<?php

use AndreaMarelli\ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = Database::OECM_CONNECTION;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('context_species_vegetal_presence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->integer('SpeciesID')->nullable();
            $table->boolean('ExploitedSpecies')->nullable();
            $table->boolean('ProtectedSpecies')->nullable();
            $table->boolean('DisappearingSpecies')->nullable();
            $table->boolean('InvasiveSpecies')->nullable();
            $table->string('PopulationEstimation', 50)->nullable();
            $table->text('DescribeEstimation')->nullable();
            $table->text('Comments')->nullable();
            $table->string('species', 250)->nullable();

            $table->foreign(['FormID'], 'FormID_fk')
                ->references(['FormID'])
                ->on('imet_form')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('context_species_vegetal_presence');
    }
};