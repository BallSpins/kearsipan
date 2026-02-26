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
        Schema::create('classifications', function (Blueprint $table) {
            $table->string('code', 25)->primary();
            $table->string('parent_code', 25)->nullable(); // kode induk

            $table->text('name')->nullable(false); // nama klasifikasi

            $table->timestamps(); // created_at dan updated_at
    
            $table->foreign('parent_code') // nama column yang akan diberi foreign key
                    ->references('code') // referensi column yang akan dipakai
                    ->on('classifications') // referensi table
                    ->cascadeOnDelete(); // data akan ikut terhapus jika column referennsi juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications');
    }
};
