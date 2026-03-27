<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAttachmentRequest;
use App\Services\LetterRequestAttachmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LetterRequestAttachmentController extends Controller
{
    protected $attachmentService;
    
    public function __construct(
        LetterRequestAttachmentService $attachmentService,
    ) {
        $this->attachmentService = $attachmentService;
    }

    public function downloadAttachment(LetterRequestAttachmentService $attachment): BinaryFileResponse
    {
        $path = storage_path('app/public/' . $attachment->file_path);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan di server.');
        }
        
        return response()
                ->download($path, $attachment->file_name);
    }

    /**
     * Memperbarui lampiran spesifik (1)
     */
    public function updateSpecificAttachment(UpdateAttachmentRequest $request, Attachment $attachment): RedirectResponse
    {
        $this->attachmentService->updateAttachment($attachment, $request->file('file'));

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil diperbarui');
    }

    /**
     * Menghapus lampiran spesifik (1) pada permintaan
     */
    public function deleteSpecificAttachment(Request $_, Attachment $attachment): RedirectResponse
    {
        $this->attachmentService->deleteAttachment($attachment);

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil dihapus');
    }

    /**
     * Menghapus semua lampiran milik permintaan
     */
    public function deleteAllAttachment(Request $_, Letter $letter): RedirectResponse
    {
        foreach($letter->attachments as $attachment) {
            $this->attachmentService->deleteAttachment($attachment);
        }

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil dihapus');
    }
}
