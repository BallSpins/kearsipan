<?php

namespace App\Http\Controllers;

use App\Enums\DispositionStatus;
use App\Http\Requests\Letter\StoreDispositionRequest;
use App\Models\Disposition;
use App\Models\Letter;
use App\Services\DispositionService;
use Exception;
use Illuminate\Http\RedirectResponse;

class DispositionController extends Controller
{
    protected $dispositionService;

    public function __construct(DispositionService $dispositionService)
    {
        $this->dispositionService = $dispositionService;
    }

    /**
     * Menyimpan disposisi baru (Oleh Kepsek)
     */
    public function store(StoreDispositionRequest $request, Letter $letter): RedirectResponse
    {
        try {
            $this->dispositionService->createDisposition($letter, $request->validated());
            
            return redirect()->route('kepsek.incoming.view')
                ->with('success', 'Disposisi berhasil dikirimkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Waka menandai bahwa disposisi sedang dikerjakan (ON_PROGRESS)
     */
    public function markAsProcessing(Disposition $disposition): RedirectResponse
    {
        $this->authorizeAccess($disposition);

        $this->dispositionService->updateDispositionStatus(
            $disposition, 
            DispositionStatus::IN_PROGRESS // Pastikan Enum ini ada
        );

        return redirect()->back()->with('success', 'Status diperbarui: Sedang dikerjakan.');
    }

    /**
     * Waka menandai bahwa disposisi telah selesai (COMPLETED)
     * Ini akan mentrigger checkAndArchiveLetter di Service
     */
    public function markAsCompleted(Disposition $disposition): RedirectResponse
    {
        $this->authorizeAccess($disposition);

        $this->dispositionService->updateDispositionStatus(
            $disposition, 
            DispositionStatus::COMPLETED
        );

        // $this->dispositionService->

        return redirect()->route('waka.incoming.view')->with('success', 'Tugas selesai. Sistem akan mengecek status arsip surat.');
    }

    /**
     * Helper untuk memastikan hanya penerima yang bisa mengubah status
     */
    private function authorizeAccess(Disposition $disposition): void
    {
        if ($disposition->receiver_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah status disposisi ini.');
        }
    }
}
