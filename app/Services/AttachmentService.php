<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\Letter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttachmentService
{
    /**
     * Menambahkan file lampiran ke Letter
     */
    public function addAttachment(Letter $letter, UploadedFile $file): Attachment
    {
        // Struktur: letters/{id}/attachments/nama_file.pdf
        $path = "letters/{$letter->id}/attachments";

        $finalPath = $file->store($path, 'public');

        return $letter->attachments()->create([
            'file_path' => $finalPath,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
        ]);
    }

    /**
     * Mengambil semua lampiran milik sebuah surat
     */
    public function getAttachmentsByLetter(Letter $letter): Collection
    {
        return $letter->attachments;
    }

    /**
     * Mengganti file lampiran yang spesifik.
     * Berguna jika user ingin merevisi satu lampiran saja tanpa menghapus record nya
     */
    public function updateAttachment(Attachment $attachment, UploadedFile $newFile): Attachment
    {
        return DB::transaction(function () use ($attachment, $newFile) {
            $oldPath = $attachment->file_path;
    
            // Simpan file baru di folder yang sama (letters/{letter_id}/attachments)
            $path = "letters/{$attachment->letter_id}/attachments";
            $finalPath = $newFile->store($path, 'public');
    
            // Update metadata di database
            $updated = $attachment->update([
                'file_path' => $finalPath,
                'file_name' => $newFile->getClientOriginalName(),
                'file_type' => $newFile->getClientMimeType(),
            ]);

            if ($updated && $oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
    
            return $attachment;
        });
    }

    /**
     * Menghapus data lampiran dan file fisiknya
     */
    public function deleteAttachment(Attachment $attachment): bool
    {
        // 1. Hapus file fisik
        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        // 2. Hapus record database
        return $attachment->delete();
    }
}
