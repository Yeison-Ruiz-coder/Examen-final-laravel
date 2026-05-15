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
        Schema::create('soldiers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('grado');

            $table->foreignId('army_corp_id')
                ->nullable()
                ->constrained('army_corps')
                ->onDelete('set null');

            $table->foreignId('quarter_id')
                ->nullable()
                ->constrained('quaters')
                ->onDelete('set null');

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soldiers');
    }
};
