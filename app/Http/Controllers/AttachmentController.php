<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAttachmentRequest;
use App\Models\Attachment;
use App\Models\Letter;
use App\Services\AttachmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AttachmentController extends Controller
{
    protected $attachmentService;
    
    public function __construct(
        AttachmentService $attachmentService,
    ) {
        $this->attachmentService = $attachmentService;
    }

    public function downloadAttachment(Attachment $attachment): BinaryFileResponse
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
     * Menghapus lampiran spesifik (1) pada surat
     */
    public function deleteSpecificAttachment(Request $_, Attachment $attachment): RedirectResponse
    {
        $this->attachmentService->deleteAttachment($attachment);

        return redirect()
                ->back()
                ->with('success', 'Lampiran berhasil dihapus');
    }

    /**
     * Menghapus semua lampiran milik surat
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
