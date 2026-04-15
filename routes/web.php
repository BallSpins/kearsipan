<?php

use App\Enums\UserRole;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterRequestAttachmentController;
use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Requests\LetterRequest\StoreOutgoingRequest;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

// ============================================================================
// START AUTH
// ============================================================================

// route untuk menampilkan halaman login (GET /login)
Route::get('/login', [UserController::class, 'loginView'])
    ->name('login.view');

// route untuk memproses autentikasi user (POST /login). Note: data divalidasi di app/Http/Requests/AuthRequest.php (username, password minimal 8 karakter)
Route::post('/login', [UserController::class, 'authenticate'])
    ->name('login');

// ============================================================================
// END AUTH
// ============================================================================

// route fallback ketika URL tidak ditemukan akan redirect ke login (GET *)
Route::fallback(function (): RedirectResponse {
    return redirect()->route('login.view');
});

Route::middleware([
    'auth',
])->group(function () {

    // route untuk proses logout user (GET /logout). Note: cleanup session dan regenerate token
    Route::get('/logout', [UserController::class, 'logout'])
        ->name('logout');

    // route untuk menampilkan halaman dashboard utama (GET /dashboard)
    Route::get('/dashboard', function (): View {
        return view('dashboard');
    });

    // route untuk menampilkan halaman template surat (GET /templates)
    Route::get('/templates', [TemplateController::class, 'index'])
        ->name('templates.index');

    // ========================================================================
    // FILE DOWNLOAD GROUP
    // ========================================================================
    Route::prefix('download')
        ->name('download.')
        ->group(function () {
            // Download Template Surat
            Route::prefix('template')
                ->name('template')
                ->group(function () {
                    // route untuk download template surat berdasarkan slug (GET /download/template/{slug})
                    // Note: Menggunakan route model binding dengan slug. Parameter {template:slug} diisi slug template dari LetterTemplate model.
                    Route::get('/{template:slug}', [TemplateController::class, 'download'])
                        ->name('.download');
                });

            // Download Surat Masuk (Incoming)
            Route::prefix('incoming')
                ->name('incoming')
                ->group(function () {
                    // route untuk download surat masuk dalam format PDF/Word (GET /download/incoming/{letter})
                    // Note: Parameter {letter} diisi letter id. Method downloadIncoming() dari LetterController
                    Route::get('/{letter}', [LetterController::class, 'downloadIncoming']);

                    // route untuk download attachment/lampiran surat masuk (GET /download/incoming/attachment/{attachment})
                    // Note: Parameter {attachment} diisi attachment id. Hanya untuk file lampiran, bukan file utama surat.
                    Route::get('/attachment/{attachment}', [AttachmentController::class, 'downloadAttachment'])
                        ->name('.attachment');
                });

            // Download Surat Keluar (Outgoing)
            Route::prefix('outgoing')
                ->name('outgoing')
                ->group(function () {
                    // route untuk download surat keluar/request (GET /download/outgoing/{letter})
                    // Note: Parameter {letter} diisi letter request id. Method downloadOutgoing() dari LetterRequestController
                    Route::get('/{letter}', [LetterRequestController::class, 'downloadOutgoing']);

                    // route untuk download attachment/lampiran surat keluar (GET /download/outgoing/attachment/{attachment})
                    // Note: Parameter {attachment} diisi letter request attachment id. Hanya untuk file lampiran pendukung.
                    Route::get('/attachment/{attachment}', [LetterRequestAttachmentController::class, 'downloadAttachment'])
                        ->name('.attachment');
                });
        });


    // ========================================================================
    // USER MANAGEMENT GROUP (ADMIN ONLY)
    // Middleware: role ADMIN
    // ========================================================================
    Route::prefix('users')
        ->name('users.')
        ->middleware([
            'role:' . UserRole::only(UserRole::ADMIN),
        ])->group(function () {
            // route untuk menampilkan daftar semua user dengan pagination 10 per halaman (GET /users)
            Route::get('/', [UserController::class, 'indexUserView'])
                ->name('index');

            // route untuk menampilkan halaman form create user baru dengan daftar role yang tersedia (GET /users/create)
            Route::get('/create', [UserController::class, 'createUserView'])
                ->name('create');

            // route untuk menampilkan halaman form edit user (GET /users/edit/{user})
            // Note: Parameter {user} diisi user id. Menampilkan form dengan data user yang sudah ada untuk di-update.
            Route::get('/edit/{user}', [UserController::class, 'editUserView'])
                ->name('edit');

            // route untuk menyimpan user baru ke database (POST /users)
            // Note: Data divalidasi di app/Http/Requests/UserRequest.php (name, username unik, role, password minimal 8 karakter + confirmed, conditional required)
            Route::post('/', [UserController::class, 'storeUser'])
                ->name('store');

            // route untuk memperbarui data user yang sudah ada (PUT /users/{user})
            // Note: Parameter {user} diisi user id. Data divalidasi di app/Http/Requests/UserRequest.php. Password bersifat optional pada update.
            Route::put('/{user}', [UserController::class, 'updateUser'])
                ->name('update');

            // route untuk menghapus user dari database (DELETE /users/{user})
            // Note: Parameter {user} diisi user id. Akan menghapus user secara permanen.
            Route::delete('/{user}', [UserController::class, 'deleteUser'])
                ->name('delete');
        });

    // ========================================================================
    // CLASSIFICATION MANAGEMENT GROUP (KEPALA TU ONLY)
    // Middleware: role KEPALA_TU
    // ========================================================================
    Route::prefix('classifications')
        ->name('classifications.')
        ->middleware([
            'role:' . UserRole::only(UserRole::KEPALA_TU),
        ])->group(function () {
            // route untuk menampilkan dashboard khusus KEPALA TU (GET /classifications/dashboard)
            Route::get('/dashboard', function () {
                return view('dashboardTu');
            })->name('dashboard');

            // route untuk menampilkan daftar semua klasifikasi surat dengan pagination (GET /classifications)
            Route::get('/', [ClassificationController::class, 'indexClassificationsView'])
                ->name('index');

            // route untuk menampilkan halaman form create klasifikasi baru dengan daftar parent classification (GET /classifications/create)
            Route::get('/create', [ClassificationController::class, 'createClassificationView'])
                ->name('create');

            // route untuk menampilkan halaman form edit klasifikasi (GET /classifications/edit/{classification})
            // Note: Parameter {classification} diisi classification id. Menampilkan form dengan data klasifikasi untuk di-update.
            Route::get('/edit/{classification}', [ClassificationController::class, 'editClassificationView'])
                ->name('edit');

            // route untuk menyimpan klasifikasi surat baru ke database (POST /classifications)
            // Note: Data divalidasi di app/Http/Requests/ClassificationRequest.php (code, parent_code, name)
            Route::post('/', [ClassificationController::class, 'storeClassification'])
                ->name('store');

            // route untuk memperbarui data klasifikasi yang sudah ada (PUT /classifications/{classification})
            // Note: Parameter {classification} diisi classification id. Data divalidasi di app/Http/Requests/ClassificationRequest.php
            Route::put('/{classification}', [ClassificationController::class, 'updateClassification'])
                ->name('update');

            // route untuk menghapus klasifikasi dari database (DELETE /classifications/{classification})
            // Note: Parameter {classification} diisi classification id. Akan menghapus klasifikasi secara permanen.
            Route::delete('/{classification}', [ClassificationController::class, 'deleteClassification'])
                ->name('delete');
        });

    // ========================================================================
    // KEPALA SEKOLAH (KEPSEK) GROUP
    // Middleware: role KEPALA_SEKOLAH
    // Fitur: Review surat masuk, buat disposisi, tanda tangan surat keluar
    // ========================================================================
    Route::prefix('kepsek')
        ->name('kepsek.')
        ->middleware([
            'role:' . UserRole::only(UserRole::KEPALA_SEKOLAH),
        ])->group(function () {
            // route untuk menampilkan dashboard khusus KEPALA SEKOLAH (GET /kepsek/dashboard)
            Route::get('/dashboardKepsek', [LetterController::class, 'indexDashboardKepsekView'])
                ->name('dashboardkep.view');

            // route untuk menampilkan daftar surat masuk baru yang belum di-review (GET /kepsek/incoming)
            // Status: RECEIVED. Hanya menampilkan surat yang baru diterima oleh sistem.
            Route::get('/incoming', [LetterController::class, 'indexIncomingNewView'])
                ->name('incoming.view');

            // route untuk menampilkan detail surat masuk untuk di-review dan didisposisikan (GET /kepsek/incoming/detail/{letter})
            // Note: Parameter {letter} diisi letter id. Hanya surat dengan type INCOMING dan status RECEIVED yang bisa diakses.
            Route::get('/incoming/detail/{letter}', [LetterController::class, 'detailIncomingNewView'])
                ->name('incoming.detail.view');

            // route untuk memonitor status disposisi surat yang sudah didisposisikan kepada WAKA (GET /kepsek/dispositions/detail/{letter})
            // Note: Parameter {letter} diisi letter id. Hanya surat dengan status DISPATCHED yang bisa dimonitor. Menampilkan status setiap disposisi.
            Route::get('/dispositions/detail/{letter}', [LetterController::class, 'monitorDispositionView'])
                ->name('dispositions.detail.view');

            // route untuk membuat disposisi surat masuk (menugaskan ke WAKA) (POST /kepsek/dispositions/{letter})
            // Note: Parameter {letter} diisi letter id. Data divalidasi di app/Http/Requests/Letter/StoreDispositionRequest.php
            // Data disposisi mencakup: array dispositions dengan receiver_id dan instruction untuk masing-masing WAKA
            Route::post('/dispositions/{letter}', [DispositionController::class, 'store'])
                ->name('dispositions.store');

            // route untuk menampilkan daftar surat keluar yang sudah siap untuk ditanda tangani (GET /kepsek/ready-to-sign)
            // Status: VALIDATED. Hanya surat keluar yang sudah lolos review dari KATU dan WAKA.
            Route::get('/ready-to-sign', [LetterController::class, 'indexReadyToSignView'])
                ->name('outgoing.sign.view');

            // route untuk menampilkan detail surat keluar untuk ditanda tangani (GET /kepsek/ready-to-sign/detail/{letter})
            // Note: Parameter {letter} diisi letter id. Menampilkan draft surat yang sudah final sebelum TTD.
            Route::get('/ready-to-sign/detail/{letter}', [LetterController::class, 'signLetterView'])
                ->name('outgoing.sign.detail.view');
                
            // route untuk upload file surat yang sudah ditanda tangani (POST /kepsek/ready-to-sign/{letter})
            // Note: Parameter {letter} diisi letter id. Data divalidasi di app/Http/Requests/Letter/UpdateSignedLetterRequest.php
            // File harus PDF dan maksimal 5MB. Status surat akan berubah menjadi COMPLETED setelah upload.
            Route::post('/ready-to-sign/{letter}', [LetterController::class, 'uploadSignedLetter'])
                ->name('outgoing.sign');
        });

    // ========================================================================
    // KEPALA TU (KATU) GROUP
    // Middleware: role KEPALA_TU
    // Fitur: Review dan validasi surat keluar hasil request dari WAKA
    // ========================================================================
    Route::prefix('katu')
        ->name('katu.')
        ->middleware([
            'role:' . UserRole::only(UserRole::KEPALA_TU),
        ])->group(function () {
            Route::get('/review', [LetterController::class, 'indexReviewView'])
                ->name('review.index.view');
                
            // route untuk menampilkan halaman review surat keluar (GET /katu/review/{letter})
            // Note: Parameter {letter} diisi letter id. Menampilkan form untuk approve atau reject surat.
            Route::get('/review/{letter}', [LetterController::class, 'reviewLetterView'])
                ->name('review.view');

            // route untuk memproses review surat keluar (approve atau reject) (POST /katu/review/{letter})
            // Note: Parameter {letter} diisi letter id. Data divalidasi di app/Http/Requests/Letter/ReviewLetterRequest.php
            // action: 'approve' atau 'reject'. Jika reject, note wajib diisi. Method processReview() di LetterService menangani logika perubahan status.
            Route::post('/review/{letter}', [LetterController::class, 'review'])
                ->name('review');
        });

    // ========================================================================
    // TU (TATA USAHA) GROUP
    // Middleware: role KEPALA_TU atau TU
    // Fitur: Registrasi surat masuk, manage letter request, edit draft, upload lampiran
    // ========================================================================
    Route::prefix('tu')
        ->name('tu.')
        ->middleware([
            'role:' . UserRole::only(UserRole::KEPALA_TU, UserRole::TU),
        ])->group(function () {
            // route untuk menampilkan dashboard khusus TU (GET /tu/dashboard)
            Route::get('/dashboard', [LetterController::class, 'TUDashboardView'])->name('dashboard');

            // ====================================================================
            // LETTER REQUEST (Permintaan Surat dari WAKA) - TU Management
            // ====================================================================

            Route::get('/request/create/{letterRequest}', [LetterRequestController::class, 'createOutgoingView'])
                ->name('request.create.outgoing.view');

            // route untuk menampilkan daftar semua permintaan surat (letter request) dari WAKA (GET /tu/request)
            // Status: pending, approved, rejected, completed. Dengan pagination 10 per halaman.
            Route::get('/request', [LetterRequestController::class, 'indexTURequestView'])
                ->name('request.list.view');

            // route untuk menampilkan detail permintaan surat (GET /tu/request/detail/{request})
            // Note: Parameter {request} diisi letter request id. Menampilkan data request, draft file, dan status progress.
            Route::get('/request/detail/{request}', [LetterRequestController::class, 'detailTURequestView'])
                ->name('request.detail.view');

            // route untuk menyetujui permintaan surat dan membuatnya menjadi surat keluar resmi (POST /tu/request/approve/{request})
            // Note: Parameter {request} diisi letter request id. Data divalidasi di app/Http/Requests/LetterRequest/ApproveLetterRequest.php
            // Setelah approve, sistem membuat Letter baru dengan tipe OUTGOING dan status DRAFT.
            Route::post('/request/approve/{request}', [LetterRequestController::class, 'approve'])
                ->name('request.approve');

            // route untuk menghapus permintaan surat (DELETE /tu/request/delete/{request})
            // Note: Parameter {request} diisi letter request id. Hanya permintaan dengan status pending yang bisa dihapus. 
            // Dapat dihapus oleh pemilik (WAKA) atau TU/KATU.
            Route::delete('/request/delete/{request}', [LetterRequestController::class, 'destroy'])
                ->name('request.delete');

            // ====================================================================
            // INCOMING LETTER (Surat Masuk) - Registration & Draft Management
            // ====================================================================

            // route untuk menampilkan antrian surat masuk yang belum selesai diregistrasi (GET /tu/incoming)
            // Status: DRAFT. Menampilkan surat yang masih dalam proses pengisian data untuk review.
            Route::get('/incoming', [LetterController::class, 'indexIncomingView'])
                ->name('incoming.view');

            // route untuk menampilkan form create/registrasi surat masuk baru (GET /tu/draft/create)
            // Menampilkan form dengan dropdown classifications, fields untuk input nomor asal, tracking number, dll.
            Route::get('/draft/create', [LetterController::class, 'createDraftView'])
                ->name('incoming.draft.create.view');

            // route untuk menampilkan form edit draft surat masuk (GET /tu/draft/edit/{letter})
            // Note: Parameter {letter} diisi letter id. Hanya surat dengan status DRAFT yang bisa diedit.
            Route::get('/draft/edit/{letter}', [LetterController::class, 'letterDraftDetailView'])
                ->name('incoming.draft.edit.view');

            // ====================================================================
            // OUTGOING LETTER (Surat Keluar) - Draft Management
            // ====================================================================

            // route untuk menampilkan daftar draft surat keluar hasil approval dari WAKA request (GET /tu/outgoing)
            // Status: DRAFT. Menampilkan surat keluar yang siap untuk review dari KATU/WAKA.
            Route::get('/outgoing', [LetterController::class, 'indexOutgoingView'])
                ->name('outgoing.view');

            Route::get('/outgoing/edit/{letter}', [LetterController::class, 'editOutgoingLetter'])
                ->name('outgoing.edit');
            Route::put('/outgoing/{letter}', [LetterController::class, 'updateOutgoingLetter'])
                ->name('outgoing.update');

            // route untuk menampilkan detail draft surat (incoming atau outgoing) (GET /tu/draft/detail/{letter})
            // Note: Parameter {letter} diisi letter id. Hanya surat dengan status DRAFT yang bisa dilihat. 
            // Jika OUTGOING, juga menampilkan data LetterRequest terkait.
            Route::get('/draft/detail/{letter}', [LetterController::class, 'letterDraftDetailView'])
                ->name('draft.detail.view');

            // route untuk menampilkan daftar surat yang sudah completed/archived (GET /tu/archived)
            // Status: COMPLETED. Menampilkan surat masuk & keluar yang sudah selesai proses.
            Route::get('/archived', [LetterController::class, 'indexArchivedView'])
                ->name('archived');

            Route::get('/archived/detail/{letter}', [LetterController::class, 'archivedDetailView'])
                ->name('archived.detail.view');

            // route untuk meregistrasi/membuat surat masuk baru (POST /tu/incoming)
            // Note: Data divalidasi di app/Http/Requests/Letter/StoreIncomingRequest.php
            // Membuat Letter dengan type INCOMING, status DRAFT. Upload file utama dan lampiran jika ada.
            // Route::post('/incoming', function (Request $request) {
            //     dd($request->all());
            // })
            //     ->name('incoming');
            Route::post('/incoming', [LetterController::class, 'storeIncoming'])
                ->name('incoming');

            Route::post('/outgoing/{letterRequest}', [LetterRequestController::class, 'approve'])
                ->name('outgoing');

            Route::post('/outgoing/send-review/{letter}', [LetterController::class, 'finalizeToReviewing'])
                ->name('outgoing.send.review');

            Route::post('/give-kepsek/{letter}', [LetterController::class, 'giveToKepsek'])
                ->name('incoming.give.kepsek');

            // route untuk mengirim surat masuk ke proses review/validasi oleh KEPSEK (POST /tu/incoming/finalize/{letter})
            // Note: Parameter {letter} diisi letter id. Mengubah status dari DRAFT menjadi RECEIVED.
            Route::post('/incoming/finalize/{letter}', [LetterController::class, 'finalizeToReviewing'])
                ->name('incoming.finalize');

            // route untuk memperbarui draft surat masuk (PUT /tu/incoming/{letter})
            // Note: Parameter {letter} diisi letter id. Update data surat dan re-upload file jika ada.
            Route::put('/incoming/{letter}', [LetterController::class, 'updateLetter'])
                ->name('incoming.update');

            // ====================================================================
            // LETTER ATTACHMENT (Lampiran Surat Masuk) - Management
            // ====================================================================

            // route untuk memperbarui 1 lampiran specific pada surat masuk (PUT /tu/incoming/attachment/{attachment})
            // Note: Parameter {attachment} diisi attachment id. Data divalidasi di app/Http/Requests/UpdateAttachmentRequest.php
            // File harus PDF/DOC/DOCX dan maksimal 5MB.
            Route::put('/incoming/attachment/{attachment}', [AttachmentController::class, 'updateSpecificAttachment'])
                ->name('incoming.attachment.update');

            // route untuk menghapus 1 lampiran specific pada surat masuk (DELETE /tu/incoming/attachment/{attachment})
            // Note: Parameter {attachment} diisi attachment id. Menghapus file dari storage dan database.
            Route::delete('/incoming/attachment/{attachment}', [AttachmentController::class, 'deleteSpecificAttachment'])
                ->name('incoming.attachment.delete');

            // route untuk menghapus semua lampiran pada surat masuk (DELETE /tu/incoming/attachment/letter/{letter})
            // Note: Parameter {letter} diisi letter id. Menghapus semua attachment files dari storage dan database.
            Route::delete('/incoming/attachment/letter/{letter}', [AttachmentController::class, 'deleteAllAttachment'])
                ->name('incoming.attachment.delete.all');
        });

    // ========================================================================
    // WAKA (WAKIL KEPALA SEKOLAH) GROUP
    // Middleware: role WAKA
    // Fitur: Review surat keluar, kelola disposisi surat masuk, manage letter request attachments
    // ========================================================================
    Route::prefix('waka')
        ->name('waka.')
        ->middleware([
            'role:' . UserRole::only(UserRole::WAKA),
        ])->group(function () {
            Route::get('/dashboard', [LetterRequestController::class, 'dashboardWaka'])
                ->name('dashboard');

            Route::get('/review', [LetterController::class, 'indexReviewView'])
                ->name('review.index.view');

            Route::post('/request', [LetterRequestController::class, 'store'])
                ->name('request.store');

            // route untuk menampilkan halaman review surat keluar (GET /waka/review/{letter})
            // Note: Parameter {letter} diisi letter id. WAKA hanya bisa review jika dia adalah reviewer yang ditunjuk di LetterValidate.
            Route::get('/review/{letter}', [LetterController::class, 'reviewLetterView'])
                ->name('review.view');

            // route untuk memproses review surat keluar (approve atau reject) (POST /waka/review/{letter})
            // Note: Parameter {letter} diisi letter id. Data divalidasi di app/Http/Requests/Letter/ReviewLetterRequest.php
            // action: 'approve' atau 'reject'. Jika reject, note wajib diisi. Check di controller bahwa WAKA adalah reviewer yang ditunjuk.
            Route::post('/review/{letter}', [LetterController::class, 'review'])
                ->name('review');

            Route::get('/requests', [LetterRequestController::class, 'indexWakaRequestView'])
                ->name('request.view');

            Route::get('/requests/detail/{request}', [LetterRequestController::class, 'detailWakaRequestView'])
                ->name('request.detail.view');

            Route::get('/requests/create', [LetterRequestController::class, 'createRequestView'])
                ->name('request.create.view');

            // ====================================================================
            // DISPOSITION (Disposisi Surat Masuk) - Assigned to WAKA
            // ====================================================================

            // route untuk menampilkan daftar surat masuk yang didisposisikan kepada WAKA oleh KEPSEK (GET /waka/incoming)
            // Status: DISPATCHED. Hanya surat dengan disposisi yang dituju ke WAKA dengan receiver_id = auth()->id().
            Route::get('/incoming', [LetterController::class, 'indexWakaDispositionView'])
                ->name('incoming.view');

            // route untuk menampilkan detail surat masuk dan disposisinya yang ditujukan ke WAKA (GET /waka/incoming/detail/{letter})
            // Note: Parameter {letter} diisi letter id. Hanya menampilkan disposisi dengan receiver_id = auth()->id().
            Route::get('/incoming/detail/{letter}', [LetterController::class, 'detailDispositionView'])
                ->name('incoming.detail.view');

            // route untuk menandai disposisi sebagai sedang dikerjakan (POST /waka/incoming/process/{disposition})
            // Note: Parameter {disposition} diisi disposition id. Mengubah status disposisi menjadi IN_PROGRESS. 
            // Hanya receiver dari disposisi yang bisa mengubah status.
            Route::post('/incoming/process/{disposition}', [DispositionController::class, 'markAsProcessing'])
                ->name('dispositions.process');

            // route untuk menandai disposisi sebagai selesai dikerjakan (POST /waka/incoming/complete/{disposition})
            // Note: Parameter {disposition} diisi disposition id. Mengubah status disposisi menjadi COMPLETED.
            // Sistem akan mengecek apakah semua disposisi surat sudah COMPLETED, jika ya maka arsipkan surat.
            Route::post('/incoming/complete/{disposition}', [DispositionController::class, 'markAsCompleted'])
                ->name('dispositions.completed');

            // ====================================================================
            // LETTER REQUEST ATTACHMENT (Lampiran Surat Keluar) - Management
            // ====================================================================

            // route untuk memperbarui 1 lampiran specific pada permintaan surat (PUT /waka/outgoing/attachment/{attachment})
            // Note: Parameter {attachment} diisi letter request attachment id. Data divalidasi di app/Http/Requests/UpdateAttachmentRequest.php
            Route::put('/outgoing/attachment/{attachment}', [LetterRequestAttachmentController::class, 'updateSpecificAttachment'])
                ->name('outgoing.attachment.update');

            // route untuk menghapus 1 lampiran specific pada permintaan surat (DELETE /waka/outgoing/attachment/{attachment})
            // Note: Parameter {attachment} diisi letter request attachment id. Menghapus file dari storage dan database.
            Route::delete('/outgoing/attachment/{attachment}', [LetterRequestAttachmentController::class, 'deleteSpecificAttachment'])
                ->name('outgoing.attachment.delete');

            // route untuk menghapus semua lampiran pada permintaan surat (DELETE /waka/outgoing/attachment/letter/{letter})
            // Note: Parameter {letter} diisi letter request id. Menghapus semua attachment files dari storage dan database.
            Route::delete('/outgoing/attachment/letter/{letter}', [LetterRequestAttachmentController::class, 'deleteAllAttachment'])
                ->name('outgoing.attachment.delete.all');
        });
});
