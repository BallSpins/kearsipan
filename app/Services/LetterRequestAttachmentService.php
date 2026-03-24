<?php

namespace App\Services;

use App\Models\LetterRequest;
use App\Models\LetterRequestAttachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class LetterRequestAttachmentService
{
    /**
     * Menambahkan file lampiran ke Request
     */
    public function addAttachment(LetterRequest $request, UploadedFile $file): LetterRequestAttachment
    {
        // Struktur: requests/{id}/attachments/nama_file.pdf
        $path = "requests/{$request->id}/attachments";

        $finalPath = $file->store($path, 'public');

        return $request->attachments()->create([
            'file_path' => $finalPath,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
        ]);
    }

    /**
     * Mengganti file lampiran yang spesifik.
     * Berguna jika user ingin merevisi satu lampiran saja tanpa menghapus record nya
     */
    public function updateAttachment(LetterRequestAttachment $attachment, UploadedFile $newFile): LetterRequestAttachment
    {
        return DB::transaction(function () use ($attachment, $newFile) {
            $oldPath = $attachment->file_path;
    
            // Simpan file baru di folder yang sama (requests/{$requests->id}/attachments)
            $path = "requests/{$attachment->letter_request_id}/attachments";
            $finalPath = $newFile->store($path, 'public');
    
            // Update metadata di database
            $updated = $attachment->update([
                'file_path' => $finalPath,
                'file_name' => $newFile->getClientOriginalName(),
                'file_type' => $newFile->getClientMimeType(),
            ]);

            // Hapus file lama dari storage
            if ($updated && $oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
    
            return $attachment;
        });
    }

    /**
     * Menghapus data lampiran dan file fisiknya
     */
    public function deleteAttachment(LetterRequestAttachment $attachment): bool
    {
        // 1. Hapus file fisik
        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        // 2. Hapus record database
        return $attachment->delete();
    }
}
