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
    /**
     * Logika untuk Registrasi Surat Masuk (Incoming)
     * Langsung masuk ke antrean 'RECEIVED' untuk Kepsek.
     */
    public function registerIncomingLetter(array $data): Letter
    {
        return DB::transaction(function () use ($data) {
            // Set status default untuk antrean surat masuk
            $data['type'] = LetterType::INCOMING;
            $data['status'] = LetterStatus::RECEIVED;

            return Letter::create($data);
        });
    }

    /**
     * Logika untuk Membuat Draf Surat Keluar (Outgoing)
     * Masuk ke antrean 'DRAFT' milik TU.
     */
    public function createOutgoingDraft(array $data): Letter
    {
        $data['type'] = LetterType::OUTGOING;
        $data['status'] = LetterStatus::DRAFT;

        return Letter::create($data);
    }

    /**
     * Logika untuk memperbarui surat draft
     */
    public function updateDraftLetter(Letter $letter, array $data): Letter
    {
        if ($letter->status != LetterStatus::DRAFT) {
            throw new Exception("Hanya surat berstatus Draf yang bisa diperbarui");
        }

        return $letter->update($data);
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
        $role = auth()->user()->role; // 'katu' atau 'waka'
        $validate = $letter->letterValidate;

        if ($action === 'approve') {
            if ($role === UserRole::KEPALA_TU) {
                $validate->acc_katu = true;
                $validate->note_katu = null;
                // $letter->acc_katu = true;
                // $letter->note_katu = null; // hapus note lama kalau sudah di acc
            } elseif ($role === UserRole::WAKA) {
                $validate->acc_waka = true;
                $validate->note_waka = null;
                // $letter->acc_waka = true;
                // $letter->note_waka = null;
            }

            // cek apakah keduanya sudah acc
            // if ($letter->acc_katu && $letter->acc_waka) {
            //     $letter->status = LetterStatus::VALIDATED;
            // }
            
            if ($validate->acc_katu && $validate->acc_waka) {
                $letter->status = LetterStatus::VALIDATED;
            }
        } 
        else {
            // jika salah satu REJECT: Balik ke DRAFT & reset centang
            $letter->status = LetterStatus::DRAFT;
            $validate->acc_katu = false;
            $validate->acc_waka = false;
            // $letter->acc_katu = false;
            // $letter->acc_waka = false;

            // simpan note ke kolom yang sesuai role-nya
            if ($role === UserRole::KEPALA_TU) $validate->note_katu = $note;
            if ($role === UserRole::WAKA) $validate->note_waka = $note;
        }

        DB::transaction(function () use ($letter, $validate) {
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
        // Hapus file lama jika ada
        if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
            Storage::disk('public')->delete($letter->file_path);
        }

        // Struktur: letters/{id}/dokumen_utama.pdf
        $path = "letters/{$letter->id}";
        $fileName = $letter->id . "_" . time() . "." . $file->getClientOriginalExtension();

        $finalPath = $file->storeAs($path, $fileName, 'public');

        return $letter->update(['file_path' => $finalPath]);
    }
}
