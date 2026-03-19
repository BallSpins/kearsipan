<?php

namespace App\Http\Controllers;

use App\Services\LetterRequestAttachmentService;
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
     * Menghapus lampiran spesifik (1) pada permintaan
     */
    public function deleteSpecificAttachment(Request $_, Attachment $attachment)
    {
        $this->attachmentService->deleteAttachment($attachment);

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil dihapus');
    }

    /**
     * Menghapus semua lampiran milik permintaan
     */
    public function deleteAllAttachment(Request $_, Letter $letter)
    {
        foreach($letter->attachments as $attachment) {
            $this->attachmentService->deleteAttachment($attachment);
        }

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil dihapus');
    }
}
