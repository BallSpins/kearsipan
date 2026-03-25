<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAttachmentRequest;
use App\Services\LetterRequestAttachmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LetterRequestAttachmentController extends Controller
{
    protected $attachmentService;
    
    public function __construct(
        LetterRequestAttachmentService $attachmentService,
    ) {
        $this->attachmentService = $attachmentService;
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
