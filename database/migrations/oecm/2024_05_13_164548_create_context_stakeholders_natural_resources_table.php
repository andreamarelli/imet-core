<?php

use ImetCore\Helpers\Database;
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
        Schema::create('context_stakeholders_natural_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('Element')->nullable();
            $table->boolean('GeographicalProximity')->nullable();
            $table->text('Comments')->nullable();
            $table->string('group_key', 50)->nullable();
            $table->text('UsesCategories')->nullable();
            $table->boolean('DirectUser')->nullable();
            $table->decimal('LevelEngagement')->nullable();
            $table->decimal('LevelInterest')->nullable();
            $table->decimal('LevelExpertise')->nullable();

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
        Schema::dropIfExists('context_stakeholders_natural_resources');
    }
};
