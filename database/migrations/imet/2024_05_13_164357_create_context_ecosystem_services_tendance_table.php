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
        Schema::create('context_ecosystem_services_tendance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('Value')->nullable();
            $table->text('Description')->nullable();
            $table->text('DesiredStatus')->nullable();
            $table->decimal('Trend')->nullable();
            $table->text('Notes')->nullable();
            $table->string('Reliability', 25)->nullable();
            $table->string('group_key', 50)->nullable();

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
        Schema::dropIfExists('context_ecosystem_services_tendance');
    }
};
