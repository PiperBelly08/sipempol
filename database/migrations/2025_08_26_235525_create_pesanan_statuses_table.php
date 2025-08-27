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
        Schema::create('status_pesanan', function (Blueprint $table) {
            $table->id();
            $table->enum('nama_status', ['Pending', 'Diproses', 'Selesai', 'Dibatalkan'])->default('Pending')->values(['Pending', 'Diproses', 'Selesai', 'Dibatalkan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pesanan');
    }
};
