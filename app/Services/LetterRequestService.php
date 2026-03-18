<?php

namespace App\Services;

use App\Enums\LetterRequestStatus;
use App\Models\Letter;
use App\Models\LetterRequest;
use Illuminate\Http\UploadedFile;

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
     * logika setelah pemanggilan fungsi pembuatan Request.
     * Menyimpan file surat utama.
     */
    public function uploadFile(LetterRequest $request, UploadedFile $file): bool
    {
        // Hapus file lama jika ada
        if ($request->file_path && Storage::disk('public')->exists($request->file_path)) {
            Storage::disk('public')->delete($request->file_path);
        }

        // Struktur: requests/{id}/dokumen_utama.pdf
        $path = "requests/{$request->id}";
        $fileName = $request->id . "_" . time() . "." . $file->getClientOriginalExtension();

        $finalPath = $file->storeAs($path, $fileName, 'public');

        return $request->update(['file_path' => $finalPath]);
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
