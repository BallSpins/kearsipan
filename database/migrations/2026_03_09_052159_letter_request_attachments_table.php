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
        Schema::create('letter_request_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_request_id')->constrained('letter_requests')->cascadeOnDelete();
            $table->string('file_path'); // Lokasi penyimpanan file
            $table->string('file_name'); // Nama asli file (misal: "nota_dinas.pdf")
            $table->string('file_type'); // Mime type (pdf, jpg, docx)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_request_attachments');
    }
};
