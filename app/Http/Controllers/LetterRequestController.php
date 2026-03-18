<?php

namespace App\Http\Controllers;

use App\Services\LetterRequestAttachmentService;
use App\Services\LetterRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
