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
        Schema::create('mengajar', function (Blueprint $table) {
            $table->id();
            $table->string('id_guru');
            $table->string('id_mata_pelajaran');
            $table->string('id_kelas');
            
            // Foreign key untuk guru
            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru')
                  ->onDelete('cascade');
            
            // Foreign key untuk mata_pelajaran
            $table->foreign('id_mata_pelajaran')
                  ->references('id_mata_pelajaran')
                  ->on('mata_pelajaran')
                  ->onDelete('cascade');
            
            // Foreign key untuk kelas
            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mengajar');
    }
};