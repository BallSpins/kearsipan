<?php

namespace App\Http\Controllers;

use App\Enums\LetterType;
use App\Models\Letter;
use App\Services\AttachmentService;
use App\Services\DispositionService;
use App\Services\LetterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    // Start View function

    // Start View Surat Masuk

    /**
     * Antrean surat masuk untuk TU (Registrasi)
     */
    public function indexIncoming(): View
    {
        $letters = Letter::incomingDrafts()
                    ->with(['classification'])
                    ->latest()
                    ->paginate(10);

        return view('', compact('letters'));
    }

    /**
     * List surat masuk yang baru diterima oleh kepsek
     */
    public function indexIncomingNew(): View
    {
        $letters = Letter::incomingNew()
                    ->with(['classification'])
                    ->latest()
                    ->paginate(10);

        return view('', compact('letters'));
    }

    // End View Surat Masuk

    // Start View Surat Keluar

    public function indexOutgoing(): View
    {
        $letter = Letter::outgoingDrafts()
                    ->with(['classification'])
                    -latest()
                    ->paginate(10);

        return view('', compact('letters'));
    }

    /**
     * Antrean surat masuk untuk Waka dan Ka TU
     */
    public function indexReview(): View
    {
        $letters = Letter::waitingValidation()
                    ->with(['letterValidate', 'classification'])
                    ->latest()
                    ->paginate(10);

        return view('', compact('letters'));
    }
    
    public function indexReadyToSign(): View
    {
        $letters = Letter::readyToSign()
                    ->with('classification')
                    ->latest()
                    ->ppaginate(10);
        
        return view('', compact('letters'));
    }

    // End View Surat Keluar

    /**
     * Tampilan detail untuk surat (DRAFT) (Oleh TU)
     */
    public function letterDraftDetail(Letter $letter): View
    {
        if ($letter->status !== LetterStatus::DRAFT) {
            abort(403, 'Halaman ini hanya untuk surat berstatus draf.');
        }

        $letter->load(['attachments', 'classification']);

        if ($letter->type === LetterType::OUTGOING) {
            $letter->load('letterRequest');
        }

        $viewPath = ($letter->type === LetterType::INCOMING) 
                ? 'letters.incoming.draft' 
                : 'letters.outgoing.draft';

        return view($viewPath, compact('letter'));
    }

    /**
     * List surat yang sudah selesai (arsip)
     */
    public function indexArchived(): View
    {
        $letters = Letter::archived()
                    ->latest()
                    ->paginate(10);

        return view('', compact('letters'));
    }

    // End view function

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
     * Memperbarui Surat Masuk (Oleh TU): DRAFT
     */
    public function updateLetter(Request $request, Letter $letter): RedirectResponse
    {
        // 1. Simpan data surat terbaru
        $this->letterService->updateDraftLetter($letter, $request->all());

        // 2. Upload file utama baru jika ada
        if ($request->hasFile('file')) {
            $this->letterService->uploadFile($letter, $request->file('file'));
        }

        // 3. Upload lampiran pendukung baru jika ada
        if ($request->hasFile('attachments')) {
            // loop array file
            foreach ($request->file('attachments') as $file) {
                $this->attachmentService->addAttachment($letter, $file);
            }
        }

        return redirect()
                ->route('', $letter->id)
                ->with('success', 'Surat masuk berhasil diperbarui.');
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
