<?php

namespace App\Services;

use App\Enums\DispositionStatus;
use App\Enums\LetterStatus;
use App\Models\Disposition;
use App\Models\Letter;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class DispositionService
{
    /**
     * Membuat disposisi baru untuk surat masuk.
     * Biasanya dipanggil oleh Kepala Sekolah.
     */
    public function createDisposition(Letter $letter, array $data): void
    {
        DB::transaction(function () use ($letter, $data) {
            // Validasi: Hanya surat masuk yang sudah diterima yang bisa didisposisikan
            if ($letter->status !== LetterStatus::RECEIVED && $letter->status !== LetterStatus::DISPATCHED) {
                throw new Exception("Surat ini tidak berada dalam tahap yang dapat didisposisikan.");
            }

            foreach ($data['dispositions'] as $item) {
                $user = User::find($item['receiver_id']);

                $letter->dispositions()->create([
                    'receiver_id'   => $item['receiver_id'],
                    'receiver_role' => $user->role,
                    'instruction'   => $item['instruction'], // Instruksi spesifik per Waka
                    'status'        => DispositionStatus::PENDING,
                ]);
            }

            $letter->update(['status' => LetterStatus::DISPATCHED]);
        });
    }

    /**
     * Memperbarui status disposisi dan cek apakah surat bisa diarsip.
     */
    public function updateDispositionStatus(Disposition $disposition, DispositionStatus $status): bool
    {
        return DB::transaction(function () use ($disposition, $status) {
            // 1. Update status disposisi yang sedang dikerjakan
            $updated = $disposition->update(['status' => $status]);

            // 2. Jika status diubah jadi COMPLETED, cek kawan-kawannya (disposisi lain di surat yang sama)
            if ($disposition->status === DispositionStatus::COMPLETED) {
                $this->checkAndArchiveLetter($disposition->letter);
            }

            return $updated;
        });
    }

    /**
     * Cek apakah seluruh disposisi sudah selesai.
     * Jika ya, pindahkan status surat ke COMPLETED (Arsip).
     */
    private function checkAndArchiveLetter(Letter $letter): void
    {
        // Cek apakah masih ada disposisi yang BELUM completed
        $hasPendingDispositions = $letter->dispositions()
            ->where('status', '!=', DispositionStatus::COMPLETED)
            ->exists();

        // Jika tidak ada lagi yang pending/processing, maka arsipkan
        if (!$hasPendingDispositions) {
            $letter->update(['status' => LetterStatus::COMPLETED]);
        }
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
