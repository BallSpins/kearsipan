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
        Schema::create('letter_validate', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('letter_id')->constrained('letters')->cascadeOnDelete();

            $table->boolean('acc_katu')->default(false);
            $table->boolean('acc_waka')->default(false);
            $table->text('note_katu')->nullable();
            $table->text('note_waka')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_validate');
    }
};
