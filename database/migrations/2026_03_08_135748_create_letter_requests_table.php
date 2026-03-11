<?php

use App\Enums\LetterRequestStatus;
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
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description');
            $table->enum('status', array_column(LetterRequestStatus::cases(), 'value'))
                    ->default(LetterRequestStatus::PENDING);
            $table->text('file_path')
                    ->nullable(false);
            $table->text('note_tu')->nullable(); // Alasan jika ditolak
            $table->foreignId('letter_id')->nullable()->constrained(); // Terisi jika sudah jadi surat resmi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
