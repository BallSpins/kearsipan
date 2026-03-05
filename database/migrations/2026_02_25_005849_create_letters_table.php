<?php

use App\Enums\LetterStatus;
use App\Enums\LetterType;
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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->text('full_number');                                        // id full dari surat termasuk class_code, tanggal dll
            $table->enum('type', array_column(LetterType::cases(), 'value'))
                    ->default(LetterType::OUTGOING);                            // tipe surat (keluar/masuk)
            $table->string('classification_code', 25)
                    ->nullable();                                               // kode klasifikasi surat
            $table->string('file_number', 50)
                    ->nullable(false);                                          // no berkas
            $table->text('address')
                    ->nullable(false);                                          // alamat tujuan / alamat pengirim
            $table->text('subject')
                    ->nullable(false);                                          // perihal
            $table->string('reference_number', 50)
                    ->nullable(false);                                          // no petunjuk
            $table->integer('tracking_number')
                    ->nullable(false);                                          // pengganti no pakket / no urut
            $table->text('file_path')
                    ->nullable(false);
            $table->enum('status', array_column(LetterStatus::cases(), 'value'))// status dari surat
                    ->default(LetterStatus::DRAFT);

            $table->timestamps();                                               // created_at dan updated_at

            $table->foreign('classification_code')                              // relasi untuk classification_code kepada table classifications
                    ->references('code')
                    ->on('classifications')
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
