<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\LetterRequest\ApproveLetterRequest;
use App\Http\Requests\LetterRequest\StoreOutgoingRequest;
use App\Http\Requests\LetterRequest\UpdateRequest;
use App\Http\Requests\LetterRequest\UpdateRequestFile;
use App\Models\Letter;
use App\Models\LetterRequest;
use App\Services\ClassificationService;
use App\Services\LetterRequestAttachmentService;
use App\Services\LetterService;
use App\Services\LetterRequestService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LetterRequestController extends Controller
{
    protected $requestService;
    protected $letterService;
    protected $requestAttachmentService;
    protected $classificationService;

    public function __construct(
        LetterRequestService $requestService,
        LetterService $letterService,
        LetterRequestAttachmentService $requestAttachmentService,
        ClassificationService $classificationService
    ) {
        $this->requestService = $requestService;
        $this->letterService = $letterService;
        $this->requestAttachmentService = $requestAttachmentService;
        $this->classificationService = $classificationService;
    }

    // Start View function

    public function dashboardWaka(): View
    {
        $totalDisposedCount = Letter::assignedDisposition(auth()->id())->count();
        $totalRequestCount = LetterRequest::count();
        $disposedLetter = Letter::assignedDisposition(auth()->id())
            ->latest()
            ->limit(5)
            ->get();

        return view('waka.dashboard', compact('totalDisposedCount', 'totalRequestCount', 'disposedLetter'));
    }

    /**
     * List permintaan waka beserta statusnya (Oleh Waka)
     */
    public function indexWakaRequestView(): View
    {
        $requests = LetterRequest::byWaka(auth()->id())
                    ->with(['letter'])
                    ->latest()
                    ->paginate(10);
        
        return view('waka.requestIndex', compact('requests'));
    }

    /**
     * List permintaan waka beserta statusnya (Oleh TU)
     */
    public function indexTURequestView(): View
    {
        $requests = LetterRequest::with(['letter'])
                    ->latest()
                    ->paginate(10);
        
        return view('tu.requestIndex', compact('requests'));
    }

    /**
     * Tampilan pembuatan permintaan (oleh waka)
     */
    public function createRequestView(): View
    {
        return view('waka.createRequest');
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

        return view('waka.detailRequest', compact('request'));
    }

    /**
     * Tampilan detail dari permintaan waka. (oleh TU)
     * Dapat menampilkan status surat
     */
    public function detailTURequestView(LetterRequest $request): View
    {
        $request->load(['letter.classification', 'attachments']);

        return view('tu.requestDetail', compact('request')); // sesuaikan nama view & variabelnya
    }

    // End View function

    /**
     * Waka membuat permohonan surat baru
     */
    public function store(StoreOutgoingRequest $request): RedirectResponse
    {
        try {
            $data = $request->safe()->only(['subject', 'description', 'address']);
            
            // 1. Buat data request
            $letterRequest = $this->requestService->createRequest($data);

            // 2. Upload draf kasar jika ada
            if ($request->hasFile('draft_file')) {
                $this->requestService->uploadFile($letterRequest, $request->file('draft_file'));
            }

            // 3. Upload lampiran pendukung jika ada
            if ($request->hasFile('attachments')) {
                // loop array file
                foreach ($request->file('attachments') as $file) {
                    $this->requestAttachmentService->addAttachment($letterRequest, $file);
                }   
            }

            return redirect()
                    ->route('waka.request.view')
                    ->with('success', 'Request terkirim.');
        } catch (Exception $e) {
            return redirect()
                    ->back()
                    ->with('error', 'Gagal membuat permintaan: ' . $e->getMessage());
        }
    }

    /**
     * Memperbarui permintaan surat (Oleh Waka)
     */
    public function update(UpdateRequest $request, LetterRequest $letterRequest): RedirectResponse
    {
        // Proteksi kepemilikan
        if ($letterRequest->waka_id != auth()->id()) {
            abort(403);
        }

        // Hanya bisa diedit jika belum diproses TU (status Pending)
        if ($letterRequest->isApproved()) {
            return redirect()
                    ->back()
                    ->with('error', 'Request yang sudah disetujui tidak bisa diubah.');
        }

        $data = $request->validated();

        $this->requestService->updateRequest($letterRequest, $data);
        return redirect()
                ->back()
                ->with('success', 'Permintaan diperbarui.');
    }

    /**
     * Memperbarui file pada permintaan surat (Oleh Waka)
     */
    public function updateFile(UpdateRequestFile $request, LetterRequest $letterRequest): RedirectResponse
    {
        $this->requestService->uploadFile($letterRequest, $request->file('file'));
        return redirect()
                ->back()
                ->with('success', 'Permintaan diperbarui.');
    }

    /**
     * Menghapus permintaan surat (Oleh Waka, TU, KATU)
     */
    public function destroy(LetterRequest $letterRequest): RedirectResponse
    {
        $user = auth()->user();
        $isOwner = $letterRequest->waka_id == $user->id;
        $isStaffTU = in_array($user->role, [UserRole::TU, UserRole::KEPALA_TU]);

        // Logika: Hanya pemilik atau TU yang bisa hapus
        if (!$isOwner && !$isStaffTU) {
            abort(403, "Halaman ini hanya dapat diakses oleh pemilik prmintaan atau TU dan Kepala TU.");
        }

        // Pastikan file lampiran di storage juga ikut terhapus via Service
        $this->requestService->deleteRequest($letterRequest);
        
        return redirect()
                ->route('')
                ->with('success', 'Permintaan berhasil dihapus.');
    }

    public function downloadOutgoing(LetterRequest $letter): BinaryFileResponse
    {
        $path = storage_path('app/public/' . $letter->file_path);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan di server.');
        }
        
        return response()
                ->download($path, $letter->file_name);
    }

    public function createOutgoingView(LetterRequest $letterRequest): View
    {
        $classifications = $this->classificationService->getClassifications();

        return view('tu.createOutgoing', compact('letterRequest', 'classifications'));
    }

    /**
     * TU menyetujui request dan menjadikannya surat keluar resmi
     */
    public function approve(ApproveLetterRequest $request, LetterRequest $letterRequest): RedirectResponse
    {
        // dd($request->all());
        // $request berisi data resmi: nomor surat, klasifikasi, dsb.
        $data = $request->only(['classification_code', 'subject', 'address', 'description']);
        // dd($data);
        $letter = $this->requestService->createLetter($letterRequest, $data);

        $letterRequest->update(['letter_id' => $letter->id]);
        
        // dd($letter);
        // 2. Upload draf kasar jika ada
        if ($request->hasFile('draft_file')) {
            $this->letterService->uploadFile($letter, $request->file('draft_file'));
        }

        // 3. Upload lampiran pendukung jika ada
        if ($request->hasFile('attachments')) {
            // loop array file
            foreach ($request->file('attachments') as $file) {
                $this->letterAttachmentService->addAttachment($letter, $file);
            }   
        }

        return redirect()
                ->route('tu.request.list.view')
                ->with('success', 'Request disetujui menjadi surat resmi.');
    }
}
