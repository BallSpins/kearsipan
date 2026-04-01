<?php

namespace App\Services;

use App\Models\Letter;
use App\Models\LetterRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class LetterRequestService
{
    private LetterService $letterService;

    public function __construct(LetterService $letterService)
    {
        $this->letterService = $letterService;
    }
    
    /**
     * Logika untuk mmebuat request oleh waka kepada tu
     */
    public function createRequest(array $data): LetterRequest
    {
        $waka_id = auth()->user()->id;

        $data['waka_id'] = $waka_id;

        return LetterRequest::create($data);
    }

    /**
     * Memperbarui data permintaan surat.
     */
    public function updateRequest(LetterRequest $letterRequest, array $data): LetterRequest
    {
        // Update data dasar (subject, description)
        $letterRequest->update([
            'subject' => $data['subject'] ?? $letterRequest->subject,
            'description' => $data['description'] ?? $letterRequest->description,
        ]);

        return $letterRequest;
    }

    /**
     * Menghapus seluruh data request beserta file fisiknya.
     */
    public function deleteRequest(LetterRequest $letterRequest): bool
    {
        // 1. Hapus file draf utama
        if ($letterRequest->file_path && Storage::exists($letterRequest->file_path)) {
            Storage::delete($letterRequest->file_path);
        }

        // 2. Hapus semua file lampiran pendukung (via Relation)
        foreach ($letterRequest->attachments as $attachment) {
            if (Storage::exists($attachment->file_path)) {
                Storage::delete($attachment->file_path);
            }
            // Hapus record database lampiran
            $attachment->delete();
        }

        // 3. Hapus data utama
        return $letterRequest->delete();
    }

    /**
     * logika setelah pemanggilan fungsi pembuatan Request.
     * Menyimpan file surat utama.
     */
    public function uploadFile(LetterRequest $request, UploadedFile $file): bool
    {
        return DB::transaction(function () use ($request, $file) {
            $oldPath = $request->file_path;
    
            // Struktur: requests/{id}/dokumen_utama.pdf
            $path = "requests/{$request->id}";
            $fileName = $request->id . "_" . time() . "." . $file->getClientOriginalExtension();
    
            $finalPath = $file->storeAs($path, $fileName, 'public');
    
            $updated = $request->update(['file_path' => $finalPath]);

            // Hapus file lama jika ada
            if ($updated && $oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        });
    }

    /**
     * logika membuat Letter dari Request yang ada
     */
    public function createLetter(LetterRequest $request, array $data): Letter
    {
        return DB::transaction(function () use ($request, $data) {
            $letter = $this->letterService->createOutgoingDraft($data);

            $request->update([
                'letter_id' => $letter->id,
            ]);

            return $letter;
        });
    }
}
