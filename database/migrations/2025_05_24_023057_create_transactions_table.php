<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() 
    { 
        Schema::create('transactions', function (Blueprint $table) { 
            $table->id(); 
            $table->string('kode_transaksi')->unique(); 
            $table->string('kode_customer')->constrained('customers'); 
            $table->string('kode_produk')->constrained('products'); 
            $table->integer('quantity'); 
            $table->decimal('total_harga', 15, 2); 
            $table->enum('status', ['pending', 'done'])->default('pending'); 
            $table->dateTime('tanggal_dibayar')->nullable(); 
            $table->timestamps(); 
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
