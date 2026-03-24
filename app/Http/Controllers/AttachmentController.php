<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Letter;
use App\Services\AttachmentService;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    protected $attachmentService;
    
    public function __construct(
        AttachmentService $attachmentService,
    ) {
        $this->attachmentService = $attachmentService;
    }

    /**
     * Memperbarui lampiran spesifik (1)
     */
    public function updateSpecificAttachment(Request $request, Attachment $attachment)
    {
        if ($request->hasFile('file')) {
            $this->attachmentService->updateAttachment($attachment, $request->file('file'));
        }
    }

    /**
     * Menghapus lampiran spesifik (1) pada surat
     */
    public function deleteSpecificAttachment(Request $_, Attachment $attachment)
    {
        $this->attachmentService->deleteAttachment($attachment);

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil dihapus');
    }

    /**
     * Menghapus semua lampiran milik surat
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
