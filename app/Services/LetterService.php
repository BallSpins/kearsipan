<?php

namespace App\Services;

use App\Enums\UserRole;
use Exception;

class LetterService
{
    /**
     * Logika untuk Registrasi Surat Masuk (Incoming)
     * Langsung masuk ke antrean 'RECEIVED' untuk Kepsek.
     */
    public function registerIncomingLetter(array $data, $file = null): Letter
    {
        return DB::transaction(function () use ($data, $file) {
            // Handle upload file jika ada
            if ($file) {
                $data['file_path'] = $file->store('letters/incoming');
            }

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
     * Logika untuk Menggerakkan Antrean (Move Queue)
     * Contoh: Dari Draf ke Reviewing (Validasi Waka)
     */
    public function submitForValidation(Letter $letter): bool
    {
        if ($letter->status !== LetterStatus::DRAFT) {
            throw new Exception("Hanya surat berstatus Draf yang bisa diajukan validasi.");
        }

        return $letter->update([
            'status' => LetterStatus::REVIEWING
        ]);
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

        if ($action === 'approve') {
            if ($role === UserRole::KEPALA_TU) {
                $letter->letterValidate->acc_katu = true;
                $letter->letterValidate->note_katu = null;
                // $letter->acc_katu = true;
                // $letter->note_katu = null; // hapus note lama kalau sudah di acc
            } elseif ($role === UserRole::WAKA) {
                $letter->letterValidate->acc_waka = true;
                $letter->letterValidate->note_waka = null;
                // $letter->acc_waka = true;
                // $letter->note_waka = null;
            }

            // cek apakah keduanya sudah acc
            // if ($letter->acc_katu && $letter->acc_waka) {
            //     $letter->status = LetterStatus::VALIDATED;
            // }
            
            if ($letter->letterValidate->acc_katu && $letter->letterValidate->acc_waka) {
                $letter->status = LetterStatus::VALIDATED;
            }
        } 
        else {
            // jika salah satu REJECT: Balik ke DRAFT & reset centang
            $letter->status = LetterStatus::DRAFT;
            $letter->letterValidate->acc_katu = false;
            $letter->letterValidate->acc_waka = false;
            // $letter->acc_katu = false;
            // $letter->acc_waka = false;

            // simpan note ke kolom yang sesuai role-nya
            if ($role === UserRole::KEPALA_TU) $letter->letterValidate->note_katu = $note;
            if ($role === UserRole::WAKA) $letter->letterValidate->note_waka = $note;
        }

        $letter->save();
    }
}
