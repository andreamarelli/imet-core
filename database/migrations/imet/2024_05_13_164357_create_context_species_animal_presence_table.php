<?php

use ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = Database::IMET_CONNECTION;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('context_species_animal_presence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->integer('SpeciesID')->nullable();
            $table->boolean('FlagshipSpecies')->nullable();
            $table->boolean('EndangeredSpecies')->nullable();
            $table->boolean('EndemicSpecies')->nullable();
            $table->boolean('ExploitedSpecies')->nullable();
            $table->boolean('InvasiveSpecies')->nullable();
            $table->boolean('InsufficientDataSpecies')->nullable();
            $table->decimal('PopulationEstimation')->nullable();
            $table->decimal('DesiredPopulation')->nullable();
            $table->decimal('TrendRating')->nullable();
            $table->string('Reliability', 25)->nullable();
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
        Schema::dropIfExists('context_species_animal_presence');
    }
};
