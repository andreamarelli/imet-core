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
        Schema::create('context_governance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('Type')->nullable();
            $table->text('Comments')->nullable();
            $table->text('Partner')->nullable();
            $table->text('InstitutionType')->nullable();
            $table->text('PartnershipsType1')->nullable();
            $table->text('PartnershipsType2')->nullable();
            $table->text('PartnershipsType3')->nullable();

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
        Schema::dropIfExists('context_governance');
    }
};
