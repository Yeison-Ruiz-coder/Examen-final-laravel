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
        Schema::create('services_soldiers', function (Blueprint $table) {

            $table->unsignedBigInteger('soldier_id');
            $table->unsignedBigInteger('service_id');
            $table->primary(['soldier_id', 'service_id']);

            $table->foreign('soldier_id')->references('id')->on('soldiers')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_soldiers');
    }
};
