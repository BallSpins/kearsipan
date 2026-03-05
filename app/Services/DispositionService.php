<?php

namespace App\Services;

use App\Enums\DispositionStatus;
use App\Enums\LetterStatus;
use App\Models\Disposition;
use App\Models\Letter;
use Exception;
use Illuminate\Support\Facades\DB;

class DispositionService
{
    /**
     * Membuat disposisi baru untuk surat masuk.
     * Biasanya dipanggil oleh Kepala Sekolah.
     */
    public function createDisposition(Letter $letter, array $data): Disposition
    {
        return DB::transaction(function () use ($letter, $data) {
            // Validasi: Hanya surat masuk yang sudah diterima yang bisa didisposisikan
            if ($letter->status !== LetterStatus::RECEIVED && $letter->status !== LetterStatus::DISPATCHED) {
                throw new Exception("Surat ini tidak berada dalam tahap yang dapat didisposisikan.");
            }

            // 1. Buat data disposisi
            $disposition = $letter->dispositions()->create([
                'receiver_role' => $data['receiver_role'],
                'receiver_id'   => $data['receiver_id'],
                'instruction'   => $data['instruction'],
                'status'        => DispositionStatus::PENDING,
            ]);

            // 2. Update status surat menjadi DISPATCHED jika belum
            if ($letter->status !== LetterStatus::DISPATCHED) {
                $letter->update(['status' => LetterStatus::DISPATCHED]);
            }

            return $disposition;
        });
    }

    /**
     * Memperbarui status disposisi (misal: diselesaikan oleh Waka/Penerima).
     */
    public function updateDispositionStatus(Disposition $disposition, DispositionStatus $status): bool
    {
        return $disposition->update([
            'status' => $status
        ]);
    }

    /**
     * Mengambil daftar disposisi untuk user tertentu (Dashboard Waka/Staf).
     */
    public function getMyDispositions()
    {
        return Disposition::where('receiver_id', auth()->id())
            ->with('letter') // Load data suratnya juga
            ->latest()
            ->get();
    }

}
