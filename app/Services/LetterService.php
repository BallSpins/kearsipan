<?php

namespace App\Services;

use App\Enums\LetterStatus;
use App\Enums\LetterType;
use App\Enums\UserRole;
use App\Models\Letter;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LetterService
{
    protected $numberService;

    public function __construct(LetterNumberService $numberService)
    {
        $this->numberService = $numberService;
    }

    /**
     * Logika untuk Registrasi Surat Masuk (Incoming)
     * Langsung masuk ke antrean 'RECEIVED' untuk Kepsek.
     */
    public function registerIncomingLetter(array $data): Letter
    {
        return DB::transaction(function () use ($data) {
            $generated = $this->numberService->generateNumber(
                LetterType::INCOMING, 
                $data['classification_code']
            );

            // Set status default untuk antrean surat masuk
            $finalData = array_merge($data, [
                'type'            => LetterType::INCOMING,
                'status'          => LetterStatus::DRAFT,
                'sequence_number' => $generated['sequence_number'],
                'year'            => $generated['year'],
                'origin_number' => $data['origin_number'],
            ]);

            return Letter::create($finalData);
        });
    }

    /**
     * Logika untuk Membuat Draf Surat Keluar (Outgoing)
     * Masuk ke antrean 'DRAFT' milik TU.
     */
    public function createOutgoingDraft(array $data): Letter
    {
        return DB::transaction(function () use ($data) {
            $generated = $this->numberService->generateNumber(
                LetterType::OUTGOING, 
                $data['classification_code']
            );

            // pakai jika nomor surat baru muncul jika setelah di acc kepsek
            // $data['full_number'] = "TEMP-" . time() . "-DRAFT"; 
            // $data['sequence_number'] = 0; // Tanda belum punya urutan resmi

            $finalData = array_merge($data, [
                'type'            => LetterType::OUTGOING,
                'status'          => LetterStatus::DRAFT,
                'full_number'     => $generated['full_number'],
                'sequence_number' => $generated['sequence_number'],
                'year'            => $generated['year'],
            ]);
    
            return Letter::create($finalData);
        });
    }

    /**
     * Logika untuk memperbarui surat draft
     */
    public function updateDraftLetter(Letter $letter, array $data): bool
    {
        if ($letter->status != LetterStatus::DRAFT) {
            throw new Exception("Hanya surat berstatus Draf yang bisa diperbarui");
        }

        return $letter->update($data);
    }

    public function giveToKepsek(Letter $letter): bool
    {
        if ($letter->status !== LetterStatus::DRAFT) {
            throw new Exception("Hanya surat berstatus Draf yang bisa diajukan ke Kepsek.");
        }

        return $letter->update([
            'status' => LetterStatus::RECEIVED
        ]);
    }

    /**
     * Logika untuk Menggerakkan Antrean (Move Queue)
     * Contoh: Dari Draf ke Reviewing (Validasi Waka)
     */
    public function submitForValidation(Letter $letter): bool
    {
        if ($letter->status !== LetterStatus::DRAFT) {
            throw new Exception("Hanya surat berstatus Draf yang bisa diajukan validasi.");
        }

        if (!$letter->file_path) {
            throw new Exception("File surat resmi belum diunggah!");
        }

        return DB::transaction(function () use ($letter) {
            $letter->letterValidate()->updateOrCreate(
                ['letter_id' => $letter->id],
                [
                    'waka_id'   => $letter->letterRequest->waka_id,
                    'acc_katu'  => false,
                    'acc_waka'  => false,
                    'note_katu' => null,
                    'note_waka' => null,
                ],
            );

            return $letter->update([
                'status' => LetterStatus::REVIEWING
            ]);
        });
    }

    /**
     * Logika untuk Penyelesaian Akhir (Archived)
     */
    public function markAsCompleted(Letter $letter): bool
    {
        return $letter->update([
            'status' => LetterStatus::COMPLETED
        ]);
    }

    /**
     * Logika Persetujuan Bersama (Ka TU & Waka) dan Penanganan Revisi
     */
    public function processReview(Letter $letter, string $action, ?string $note = null): void
    {
        DB::transaction(function () use ($letter, $action, $note) {
            $role = auth()->user()->role; // 'katu' atau 'waka'

            $letter->refresh()->lockForUpdate();
            $validate = $letter->letterValidate()->lockForUpdate()->first();

            if ($action === 'approve') {
                if ($role === UserRole::KEPALA_TU) {
                    $validate->acc_katu = true;
                    $validate->note_katu = null; // hapus note lama kalau sudah di acc
                } elseif ($role === UserRole::WAKA) {
                    $validate->acc_waka = true;
                    $validate->note_waka = null;
                }
            } elseif ($action === 'reject') {
                // jika salah satu REJECT: Balik ke DRAFT & reset centang
                $letter->status = LetterStatus::DRAFT;

                $validate->acc_katu = false;
                $validate->acc_waka = false;

                // simpan note ke kolom yang sesuai role-nya
                if ($role === UserRole::KEPALA_TU) {
                    $validate->note_katu = $note;
                } elseif ($role === UserRole::WAKA) {
                    $validate->note_waka = $note;
                }
            }

            
            if ($validate->acc_katu && $validate->acc_waka) {
                $letter->status = LetterStatus::VALIDATED;
            }
                
            $validate->save();
            $letter->save();
        });
    }


    /**
     * logika setelah pemanggilan fungsi pembuatan Letter.
     * Menyimpan file surat utama.
     */
    public function uploadFile(Letter $letter, UploadedFile $file): bool
    {
        return DB::transaction(function () use ($letter, $file) {
            $oldPath = $letter->file_path;
            
            // Struktur: letters/{id}/dokumen_utama.pdf
            $path = "letters/{$letter->id}";
            $fileName = $letter->id . "_" . time() . "." . $file->getClientOriginalExtension();
            
            $finalPath = $file->storeAs($path, $fileName, 'public');
            
            $updated = $letter->update(['file_path' => $finalPath]);
            
            // Hapus file lama jika ada
            if ($updated && $oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            return true;
        });
    }
}
