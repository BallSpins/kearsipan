<?php

use App\Enums\UserRole;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterRequestAttachmentController;
use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Start Auth

Route::get('/login', [UserController::class, 'loginView']) 
    ->name('login.view');
Route::post('/login', [UserController::class, 'authenticate'])
    ->name('login');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

// End Auth

Route::prefix('users')
    ->name('users.')
    ->middleware([
        'auth',
        'role:' . UserRole::only(UserRole::ADMIN),
    ])->group(function () {
        Route::get('/', [UserController::class, 'indexUserView'])
            ->name('index');
        Route::get('/create', [UserController::class, 'createUserView'])
            ->name('create');
        Route::get('/edit/{user}', [UserController::class, 'editUserView'])
            ->name('edit');

        Route::post('/', [UserController::class, 'storeUser'])
            ->name('store');
        Route::put('/{user}', [UserController::class, 'updateUser'])
            ->name('update');
        Route::delete('/{user}', [UserController::class, 'deleteUser'])
            ->name('delete');
    });

Route::prefix('classifications')
    ->name('classifications.')
    ->middleware([
        'auth',
        'role:' . UserRole::only(UserRole::KEPALA_TU),
    ])->group(function () {
        Route::get('/', [ClassificationController::class, 'indexClassificationsView'])
            ->name('index');
        Route::get('/create', [ClassificationController::class, 'createClassificationView'])
            ->name('create');
        Route::get('/edit/{classification}', [ClassificationController::class, 'editClassificationView'])
            ->name('edit');

        Route::post('/', [ClassificationController::class, 'storeClassification'])
            ->name('store');
        Route::put('/{classification}', [ClassificationController::class, 'updateClassification'])
            ->name('update');
        Route::delete('/{classification}', [ClassificationController::class, 'deleteClassification'])
            ->name('delete');
    });

Route::prefix('kepsek')
    ->name('kepsek.')
    ->middleware([
        'auth',
        'role:' . UserRole::only(UserRole::KEPALA_SEKOLAH),
    ])->group(function () {
        Route::get('/incoming', [LetterController::class, 'indexIncomingNewView'])
            ->name('incoming.view');

        Route::get('/incoming/detail/{letter}', [LetterController::class, 'detailIncomingNewView'])
            ->name('incoming.detail.view');

        Route::get('/dispositions/detail/{letter}', [LetterController::class, 'monitorDispositionView'])
            ->name('dispositions.detail.view');

        Route::post('/dispositions/{letter}', [DispositionController::class, 'store'])
            ->name('dispositions.store');

        Route::get('/ready-to-sign', [LetterController::class, 'indexReadyToSignView'])
            ->name('outgoing.sign.view');

        Route::get('/ready-to-sign/detail/{letter}', [LetterController::class, 'signLetterView'])
            ->name('outgoing.sign.detail.view');

        Route::get('/ready-to-sign/{letter}', [LetterController::class, 'uploadSignedLetter'])
            ->name('outgoing.sign');
    });

Route::prefix('katu')
    ->name('katu.')
    ->middleware([
        'auth',
        'role:' . UserRole::only(UserRole::KEPALA_TU),
    ])->group(function () {
        Route::get('/review/{letter}', [LetterController::class, 'reviewLetterView'])
            ->name('review.view');
        
        Route::post('/review/{letter}', [LetterController::class, 'review'])
            ->name('review');
    });

Route::prefix('tu')
    ->name('tu.')
    ->middleware([
        'auth',
        'role:' . UserRole::only(UserRole::KEPALA_TU, UserRole::TU),
    ])->group(function () {
        // LetterRequest (Permintaan Surat)
        Route::get('/request', [LetterRequestController::class, 'indexTURequestView'])
            ->name('request.list.view');

        Route::get('/request/detail/{request}', [LetterRequestController::class, 'detailTURequestView'])
            ->name('request.detail.view');

        Route::post('/request/approve/{request}', [LetterRequestController::class, 'approve'])
            ->name('request.approve');

        Route::delete('/request/delete/{request}', [LetterRequestController::class, 'destroy'])
            ->name('request.delete');

        // Incoming Letter (Surat Masuk)
        Route::get('/incoming', [LetterController::class, 'indexIncomingView'])
            ->name('incoming.view');

        Route::get('/draft/create', [LetterController::class, 'createDraftView'])
            ->name('incoming.draft.create.view');

        Route::get('/draft/edit/{letter}', [LetterController::class, 'editIncomingDraftView'])
            ->name('incoming.draft.edit.view');
        
        Route::get('/outgoing', [LetterController::class, 'indexOutgoingView'])
            ->name('outgoing.view');
        
        Route::get('/draft/detail/{letter}', [LetterController::class, 'letterDraftDetailView'])
            ->name('draft.detail.view');

        Route::get('/archived', [LetterController::class, 'indexArchivedView'])
            ->name('archived');

        Route::post('/incoming', [LetterController::class, 'storeIncoming'])
            ->name('incoming');

        Route::post('/incoming/finalize/{letter}', [LetterController::class, 'finalizeToReviewing'])
            ->name('incoming.finalize');

        Route::put('/incoming/{letter}', [LetterController::class, 'updateLetter'])
            ->name('incoming.update');

        // Letter Attachment
        Route::put('/incoming/attachment/{attachment}', [AttachmentController::class, 'updateSpecificAttachment'])
            ->name('incoming.attachment.update');

        Route::delete('/incoming/attachment/{attachment}', [AttachmentController::class, 'deleteSpecificAttachment'])
            ->name('incoming.attachment.delete');

        Route::delete('/incoming/attachment/letter/{letter}', [AttachmentController::class, 'deleteAllAttachment'])
            ->name('incoming.attachment.delete.all');
    });

Route::prefix('waka')
    ->name('waka.')
    ->middleware([
        'auth',
        'role:' . UserRole::only(UserRole::WAKA),
    ])->group(function () {
        Route::get('/review/{letter}', [LetterController::class, 'reviewLetterView'])
            ->name('review.view');
        
        Route::post('/review/{letter}', [LetterController::class, 'review'])
            ->name('review');

        Route::get('/incoming', [LetterController::class, 'indexWakaDispositionView'])
            ->name('incoming.view');

        Route::get('/incoming/detail/{letter}', [LetterController::class, 'detailDispositionView'])
            ->name('incoming.detail.view');

        Route::post('/incoming/process/{disposition}', [DispositionController::class, 'markAsProcessing'])
            ->name('dispositions.process');

        Route::post('/incoming/complete/{disposition}', [DispositionController::class, 'markAsCompleted'])
            ->name('dispositions.completed');
        
        // Letter Request Attachment
        Route::put('/outgoing/attachment/{attachment}', [LetterRequestAttachmentController::class, 'updateSpecificAttachment'])
            ->name('outgoing.attachment.update');

        Route::delete('/outgoing/attachment/{attachment}', [LetterRequestAttachmentController::class, 'deleteSpecificAttachment'])
            ->name('outgoing.attachment.delete');

        Route::delete('/outgoing/attachment/letter/{letter}', [LetterRequestAttachmentController::class, 'deleteAllAttachment'])
            ->name('outgoing.attachment.delete.all');
    });