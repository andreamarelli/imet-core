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
        Schema::create('user_roles_imet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('country', 3)->nullable();
            $table->string('wdpa', 25)->nullable();
            $table->integer('last_update_by')->nullable();
            $table->string('last_update_date', 30)->nullable();

            $table->foreign(['user_id'], 'user_fk')
                ->references(['id'])
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles_imet');
    }
};
