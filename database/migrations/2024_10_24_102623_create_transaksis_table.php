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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('KodePelanggan')->nullable();
            $table->foreign('KodePelanggan')->references('KodePelanggan')->on('pelanggans')->onDelete('set null'); // Foreign key constraint
            $table->string('kode');
            $table->integer('total_harga');
            $table->integer('sub_total')->default(0);
            $table->integer('bayar')->default(0);
            $table->integer('kembalian')->default(0);
            $table->integer('biaya_admin')->default(0);
            $table->integer('discount')->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
