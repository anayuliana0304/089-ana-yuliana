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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions'); // ID transaksi
            $table->foreignId('flower_id')->constrained('flowers'); // ID bunga
            $table->integer('quantity'); // Jumlah bunga yang dibeli
            $table->unsignedBigInteger('unit_price'); // Harga per unit
            $table->unsignedBigInteger('subtotal'); // Subtotal
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
