<?php

namespace App\Http\Controllers;

use App\Enums\LetterStatus;
use App\Models\Letter;
use App\Services\AttachmentService;
use App\Services\DispositionService;
use App\Services\LetterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    protected $letterService;
    protected $attachmentService;
    protected $dispositionService;
    
    public function __construct(
        LetterService $letterService,
        AttachmentService $attachmentService,
        DispositionService $dispositionService
    ) {
        $this->letterService = $letterService;
        $this->attachmentService = $attachmentService;
        $this->dispositionService = $dispositionService;
    }

    /**
     * Registrasi Surat Masuk (Oleh TU)
     */
    public function storeIncoming(Request $request): RedirectResponse
    {
        // 1. Simpan data surat (tipe & status otomatis di service)
        $letter = $this->letterService->registerIncomingLetter($request->all());

        // 2. Upload file utama jika ada
        if ($request->hasFile('file')) {
            $this->letterService->uploadFile($letter, $request->file('file'));
        }

        // 3. Upload lampiran pendukung jika ada
        if ($request->hasFile('attachments')) {
            // loop array file
            foreach ($request->file('attachments') as $file) {
                $this->attachmentService->addAttachment($letter, $file);
            }
        }

        return redirect()
                ->route('', $letter->id)
                ->with('success', 'Surat masuk berhasil diregistrasi.');
    }

    /**
     * Finalisasi Status Surat Menjadi Reviewing (Oleh TU)
     */
    public function finalizeLetter(Request $_, Letter $letter): RedirectResponse
    {
        $this->letterService->submitForValidation($letter);

        return redirect()
                ->back()
                ->with('success', 'Surat dikirim untuk review.');
    }

    /**
     * Proses Validasi/Review (Oleh Ka TU dan Waka)
     */
    public function review(Request $request, Letter $letter): RedirectResponse
    {
        // $request->action bisa berisi 'approve' atau 'reject'
        $this->letterService->processReview($letter, $request->action, $request->note);

        return redirect()
                ->route('')
                ->with('success', 'Hasil review berhasil disimpan.');
    }

    /**
     * Membuat Disposisi (Oleh Kepsek)
     */
    public function createDisposition(Request $request, Letter $letter)
    {
        $disposition = $this->dispositionService->createDisposition($letter, $request->all());

        return redirect()
                ->route('')
                ->with('success', 'Surat di disposisikan ke yang bersangkutan.');
    }
}
