<?php

use App\Enums\DispositionStatus;
use App\Enums\UserRole;
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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('letter_id')->constrained('letters');
            $table->enum('receiver_role', array_column(UserRole::cases(), 'value'));

            $table->unsignedBigInteger('receiver_id')->nullable(false);
            $table->text('instruction')->nullable(false);

            $table->enum('status', array_column(DispositionStatus::cases(), 'value'))
                    ->default(DispositionStatus::PENDING);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
    }
};
