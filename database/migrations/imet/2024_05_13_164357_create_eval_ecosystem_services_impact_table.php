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
        Schema::create('eval_ecosystem_services_impact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('Impact')->nullable();
            $table->decimal('EvaluationScore')->nullable();
            $table->string('Type', 5)->nullable();
            $table->text('Comments')->nullable();

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
        Schema::dropIfExists('eval_ecosystem_services_impact');
    }
};
