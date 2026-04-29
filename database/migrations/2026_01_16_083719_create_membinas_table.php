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
        Schema::create('membina', function (Blueprint $table) {
            $table->id();
            $table->string('id_guru');
            $table->string('id_ekstrakurikuler');

            $table->timestamps();

            $table->unique(['id_guru', 'id_ekstrakurikuler']);

            $table->foreign('id_guru')
                ->references('id_guru')
                ->on('guru')
                ->onDelete('cascade');

            $table->foreign('id_ekstrakurikuler')
                ->references('id_ekstrakurikuler')
                ->on('ekstrakurikuler')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membina');
    }
};
