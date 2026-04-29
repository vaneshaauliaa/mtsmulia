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
        Schema::create('detail_pembelian_atk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_atk_id')->constrained('pembelian_atk')->onDelete('cascade');
            $table->foreignId('atk_id')->constrained('alat_tulis_kantor')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('harga', 10, 2);
            $table->string('satuan');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian_atk');
    }
};
