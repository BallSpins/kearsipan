<?php

namespace App\Http\Controllers;

use App\Enums\LetterStatus;
use App\Enums\LetterType;
use App\Enums\UserRole;
use App\Http\Requests\Letter\ReviewLetterRequest;
use App\Http\Requests\Letter\StoreIncomingRequest;
use App\Http\Requests\Letter\UpdateSignedLetterRequest;
use App\Models\Letter;
use App\Models\LetterRequest;
use App\Models\User;
use App\Services\AttachmentService;
use App\Services\ClassificationService;
use App\Services\DispositionService;
use App\Services\LetterService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LetterController extends Controller
{
    protected $letterService;
    protected $attachmentService;
    protected $dispositionService;
    protected $classificationService;
    
    public function __construct(
        LetterService $letterService,
        AttachmentService $attachmentService,
        DispositionService $dispositionService,
        ClassificationService $classificationService
    ) {
        $this->letterService = $letterService;
        $this->attachmentService = $attachmentService;
        $this->dispositionService = $dispositionService;
        $this->classificationService = $classificationService;
    }

    // Start View function

    // Start View Surat Masuk

    /**
     * Antrean surat masuk untuk TU (Registrasi) (oleh TU dan KATU)
     */
    public function indexDashboardKepsekView(): View{
        $totalRequestCount = Letter::readyToSign()->count();
        $totalIncomingCount = Letter::incomingNew()->count();
        $letterToSign = Letter::readyToSign()
                        ->with(['classification'])
                        ->latest()
                        ->limit(5)
                        ->get();
        return view('kepsek.dashboardKep', compact('totalRequestCount', 'totalIncomingCount', 'letterToSign'));
    }

    public function indexIncomingView(): View
    {
        $letters = Letter::incomingDrafts()
                    ->with(['classification'])
                    ->latest()
                    ->paginate(10);

        return view('tu.incomingIndex', compact('letters'));
    }

    /**
     * List surat masuk yang baru diterima oleh kepsek (oleh kepsek)
     */
    public function indexIncomingNewView(): View
    {
        $letters = Letter::incomingNew()
                    ->with(['classification'])
                    ->latest()
                    ->paginate(10);

        return view('kepsek.requestIndexKep', compact('letters'));
    }

    /**
     * List surat masuk yang di disposisikan kepada waka (oleh Waka)
     */
    public function indexWakaDispositionView(): View
    {
        $letters = Letter::assignedDisposition(auth()->id())
                    ->with(['classification', 'dispositions'])
                    ->latest()
                    ->paginate(10);

        return view('waka.incomingIndex', compact('letters'));
    }

    /**
     * Tampilan create surat masuk baru (oleh TU)
     */
    public function createDraftView(): View
    {
        $classifications = $this->classificationService->getClassifications();

        return view('tu.createLetter', compact('classifications'));
    }

    /**
     * Tampilan edit surat draft masuk (oleh TU)
     */
    public function editIncomingDraftView(Letter $letter): View
    {
        $letter->load(['attachments', 'classification']);

        $classifications = $this->classificationService->getClassifications();

        return view('', compact('letter', 'classifications'));
    }

    /**
     * Tampilan detail untuk kepsek melihat surat yang akan di disposisikan (oleh kepsek)
     */
    public function detailIncomingNewView(Letter $letter): View
    {
        if ($letter->type != LetterType::INCOMING && $letter->status != LetterStatus::RECEIVED) {
            abort(403, 'Halaman ini hanya untuk surat yang akan di-review oleh KEPSEK.');
        }

        $users = User::whereIn('role', [UserRole::WAKA])->get();

        $letter->load(['attachments', 'classification']);

        return view('kepsek.requestDetail', compact('letter', 'users'));
    }

    /**
     * Tampilan detail untuk waka melihat surat yang di disposisikan dari kepsek (oleh waka)
     */
    public function detailDispositionView(Letter $letter): View
    {
        $check = Letter::assignedDisposition(auth()->id())
                ->where('id', $letter->id)
                ->exists();

        if (!$check) {
            abort(403, 'Anda tidak memiliki akses ke disposisi surat ini.');
        }

        $letter->load(['attachments', 'classification', 'dispositions' => function($query) {
            $query->where('receiver_id', auth()->id());
        }]);

        return view('waka.incomingDetail', compact('letter'));
    }

    /**
     * Tampilan detail untuk kepsek memonitoring surat yang sedang di disposisikan kepada waka (oleh kepsek)
     */
    public function monitorDispositionView(Letter $letter): View
    {
        // Hanya surat yang sudah berstatus DISPATCHED yang bisa dipantau
        if ($letter->status !== LetterStatus::DISPATCHED) {
            abort(404, 'Surat belum didisposisikan.');
        }

        $letter->load(['attachments', 'classification', 'dispositions.receiver']);

        return view('', compact('letter'));
    }

    // End View Surat Masuk

    // Start View Surat Keluar

    /**
     * List draft surat keluar (permintaan dari waka) (oleh TU dan Ka TU)
     */
    public function indexOutgoingView(): View
    {
        $letters = Letter::outgoingDrafts()
                    ->with(['classification'])
                    ->latest()
                    ->paginate(10);

        return view('', compact('letters'));
    }

    /**
     * Antrean review surat keluar untuk Waka dan Ka TU (oleh waka dan Ka TU)
     */
    public function indexReviewView(): View
    {
        $user = auth()->user();

        $wakaId = ($user->role === UserRole::WAKA) ? $user->id : null;

        $letters = Letter::waitingValidation($wakaId)
                    ->with(['letterValidate', 'classification'])
                    ->latest()
                    ->paginate(10);
        
        if($user->role === UserRole::KEPALA_TU) {
            return view('katu.reviewIndex', compact('letters'));
        } else if ($user->role === UserRole::WAKA) {
            return view('waka.reviewIndex', compact('letters'));
        }
    }
    
    /**
     * List surat keluar yang akan di ttd kepsek (oleh kepsek)
     */
    public function indexReadyToSignView(): View
    {
        $letters = Letter::readyToSign()
                    ->with('classification')
                    ->latest()
                    ->paginate(10);
        
        return view('kepsek.requestAcc', compact('letters'));
    }

    /**
     * Tampilan untuk waka dan Ka TU me-review surat (oleh waka dan Ka TU)
     */
    public function reviewLetterView(Letter $letter): View
    {
        $user = auth()->user();
        $letter->load(['attachments', 'classification', 'letterValidate']);
        if ($user->role === UserRole::WAKA) {
            return view('waka.reviewDetail', compact('letter'));
        } else if($user->role === UserRole::KEPALA_TU) {
            return view('katu.reviewDetail', compact('letter'));
        }
    }

    /**
     * tampilan untuk ttd kepsek (oleh kepsek)
     */
    public function signLetterView(Letter $letter): View
    {
        $letter->load(['attachments', 'classification']);

        return view('kepsek.detailRequest', compact('letter'));
    }

    // End View Surat Keluar

    public function TUDashboardView(): View
    {
        $draftLetter = Letter::incomingDrafts()
                    ->orWhere(function ($q) {
                        $q->outgoingDrafts();
                    })
                    ->limit(5)
                    ->latest()
                    ->get();

        $pendingRequestCount = LetterRequest::pending()
                    ->count();

        $revisionRequestCount = Letter::revisions()
                    ->count();

        $totalRequestCount = LetterRequest::count();

        return view('tu.dashboard', compact('draftLetter', 'pendingRequestCount', 'revisionRequestCount', 'totalRequestCount'));
    }

    /**
     * Tampilan detail untuk surat (DRAFT) (Oleh TU)
     */
    public function letterDraftDetailView(Letter $letter): View
    {
        if ($letter->status !== LetterStatus::DRAFT) {
            abort(403, 'Halaman ini hanya untuk surat berstatus draf.');
        }

        $letter->load(['attachments', 'classification']);

        if ($letter->type === LetterType::OUTGOING) {
            $letter->load('letterRequest');
        }

        $classifications = $this->classificationService->getClassifications();

        return view('tu.editDraft', compact('letter', 'classifications'));
    }

    /**
     * List surat yang sudah selesai (arsip oleh TU)
     */
    public function indexArchivedView(): View
    {
        $letters = Letter::archived()
                    ->latest()
                    ->paginate(10);

        return view('tu.letterArchive', compact('letters'));
    }

    public function archivedDetailView(Letter $letter): View
    {
        if ($letter->status !== LetterStatus::COMPLETED) {
            abort(403, 'Halaman ini hanya untuk surat yang sudah diarsipkan.');
        }

        $letter->load(['attachments', 'classification']);

        return view('tu.detailArchive', compact('letter'));
    }

    // End view function

    /**
     * Registrasi Surat Masuk (Oleh TU)
     */
    public function storeIncoming(StoreIncomingRequest $request): RedirectResponse
    {
        try {
            $data = $request->safe()->except(['file', 'attachments']);

            // 1. Simpan data surat (tipe & status otomatis di service)
            $letter = $this->letterService->registerIncomingLetter($data);

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
                    ->route('tu.incoming.view')
                    ->with('success', 'Surat masuk berhasil diregistrasi.');
        } catch (Exception $e) {
            return redirect()
                    ->route('tu.incoming.view')
                    ->with('error', 'Gagal meregistrasi surat masuk: ' . $e->getMessage());
        }
    }

    public function giveToKepsek(Letter $letter): RedirectResponse
    {
        try {
            $this->letterService->giveToKepsek($letter);

            return redirect()
                    ->route('tu.incoming.view')
                    ->with('success', 'Surat berhasil diserahkan ke Kepsek.');
        } catch (Exception $e) {
            return redirect()
                    ->route('tu.incoming.view')
                    ->with('error', 'Gagal menyerahkan surat ke Kepsek: ' . $e->getMessage());
        }
    }

    /**
     * Memperbarui Surat Masuk (Oleh TU): DRAFT
     */
    public function updateLetter(Request $request, Letter $letter): RedirectResponse
    {
        try {
            $data = $request->only(['classification_code', 'origin_number', 'address', 'subject']);
            // 1. Simpan data surat terbaru
            $this->letterService->updateDraftLetter($letter, $data);

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
                    ->route('tu.incoming.view', $letter->id)
                    ->with('success', 'Surat masuk berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()
                    ->route('tu.incoming.view')
                    ->with('error', 'Gagal memperbarui surat masuk: ' . $e->getMessage());
        }
    }

    public function downloadIncoming(Letter $letter): BinaryFileResponse
    {
        $path = storage_path('app/public/' . $letter->file_path);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan di server.');
        }
        
        return response()
                ->download($path, $letter->file_name);
    }

    /**
     * Finalisasi Status Surat Menjadi Reviewing (Oleh TU)
     */
    public function finalizeToReviewing(Request $_, Letter $letter): RedirectResponse
    {
        $this->letterService->submitForValidation($letter);

        return redirect()
                ->back()
                ->with('success', 'Surat dikirim untuk review.');
    }

    /**
     * Proses Validasi/Review (Oleh Ka TU dan Waka)
     */
    public function review(ReviewLetterRequest $request, Letter $letter): RedirectResponse
    {
        $user = auth()->user();

        // Jika Waka, pastikan dia adalah Waka yang ditunjuk di LetterValidate
        if ($user->role === UserRole::WAKA && $letter->letterValidate->waka_id !== $user->id) {
            abort(403, 'Anda bukan reviewer yang ditunjuk untuk surat ini.');
        }

        // $request->action bisa berisi 'approve' atau 'reject'
        $this->letterService->processReview($letter, $request->action, $request->note);

        return redirect()
                ->route('')
                ->with('success', 'Hasil review berhasil disimpan.');
    }

    /**
     * Update file yang telah di ttd (oleh Kepsek)
     */
    public function uploadSignedLetter(UpdateSignedLetterRequest $request, Letter $letter): RedirectResponse
    {
        // 1. Validasi: Pastikan surat memang sudah di-acc semua pihak
        if ($letter->status !== LetterStatus::VALIDATED) {
            throw new Exception("Surat belum divalidasi lengkap, tidak bisa upload TTD.");
        }

        // 2. Upload file PDF Final (versi TTD)
        if ($request->hasFile('signed_file')) {
            $this->letterService->uploadFile($letter, $request->file('signed_file'));
        }

        return redirect()
                ->back()
                ->with('success', 'Surat final berhasil diunggah.');
    }

    /**
     * Finalisasi surat menjadi COMPLETED
     */
    public function finalizeToCompleted(Letter $letter): RedirectResponse
    {
        $this->letterService->markAsCompleted($letter);

        return redirect()
                ->route('')
                ->with('success', 'Surat final berhasil diarsipkan.');
    }
}
