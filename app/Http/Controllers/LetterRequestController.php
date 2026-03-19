<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Services\LetterRequestAttachmentService;
use App\Services\LetterRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LetterRequestController extends Controller
{
    protected $requestService;
    protected $attachmentService;

    public function __construct(
        LetterRequestService $requestService,
        LetterRequestAttachmentService $attachmentService
    ) {
        $this->requestService = $requestService;
        $this->attachmentService = $attachmentService;
    }

    // Start View function

    /**
     * List permintaan waka beserta statusnya (Oleh Waka)
     */
    public function indexWakaRequestView(): View
    {
        $requests = LetterRequest::byWaka(auth()->id())
                    ->with(['letter'])
                    ->latest()
                    ->paginate(10);
        
        return view('', compact('requests'));
    }

    /**
     * List permintaan waka beserta statusnya (Oleh TU)
     */
    public function indexTURequestView(): View
    {
        $requests = LetterRequest::with(['letter'])
                    ->latest()
                    ->paginate(10);
        
        return view('', compact('requests'));
    }

    /**
     * Tampilan pembuatan permintaan (oleh waka)
     */
    public function createRequestView(): View
    {
        return view('');
    }

    /**
     * Tampilan detail dari permintaan waka. (oleh Waka)
     * Dapat menampilkan status surat
     */
    public function detailWakaRequestView(LetterRequest $request): View
    {
        if ($request->waka_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke permintaan ini.');
        }

        $request->load(['letter.classification', 'attachments']);

        return view('', compact('request'));
    }

    /**
     * Tampilan detail dari permintaan waka. (oleh TU)
     * Dapat menampilkan status surat
     */
    public function detailTURequestView(LetterRequest $request): View
    {
        $request->load(['letter.classification', 'attachments']);

        return view('', compact('request'));
    }

    // End View function

    /**
     * Waka membuat permohonan surat baru
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Buat data request
        $letterRequest = $this->requestService->createRequest($request->only(['subject', 'description']));

        // 2. Upload draf kasar jika ada
        if ($request->hasFile('draft_file')) {
            $this->requestService->uploadFile($letterRequest, $request->file('draft_file'));
        }

        // 3. Upload lampiran pendukung jika ada
        if ($request->hasFile('attachments')) {
            // loop array file
            foreach ($request->file('attachments') as $file) {
                $this->attachmentService->addAttachment($letterRequest, $file);
            }   
        }

        return redirect()
                ->route('')
                ->with('success', 'Request terkirim.');
    }

    /**
     * TU menyetujui request dan menjadikannya surat keluar resmi
     */
    public function approve(Request $request, LetterRequest $letterRequest): RedirectResponse
    {
        // $request berisi data resmi: nomor surat, klasifikasi, dsb.
        $this->requestService->createLetter($letterRequest, $request->all());

        return redirect()
                ->route('')
                ->with('success', 'Request disetujui menjadi surat resmi.');
    }
}
