<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Services\ClassificationService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassificationController extends Controller
{
    protected $classificationService;

    public function __construct(ClassificationService $classificationService)
    {
        $this->classificationService = $classificationService;
    }

    // Start View function

    /**
     * Tampilan list dari seluruh klasifikasi
     */
    public function indexClassifications(): View
    {
        $classifications = $this->classificationService->getPaginatedClassifications();

        return view('', compact('classifications'));
    }

    public function createClassification(): View
    {
        return view('');
    }

    /**
     * Tampilan edit klasifikasi
     */
    public function editClassification(Classification $classification): View
    {
        return view('', compact('classification'));
    }

    // End View function

    /**
     * Logika untuk menyimpan klasifikasi baru
     */
    public function storeClassification(Request $request): RedirectResponse
    {
        try {
            $this->classificationService->createClassification($request->all());

            return redirect()
                    ->route('')
                    ->with('success', 'Klasifikasi baru berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Logika untuk memperbarui klasifikasi
     */
    public function updateClassification(Request $request, Classification $classification): RedirectResponse
    {
        try {
            $this->classificationService->updateClassification($classification, $request->all());

            return redirect()
                    ->route('')
                    ->with('success', 'Klasifikasi berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function deleteClassification(Classification $classification): RedirectResponse
    {
        try {
            $this->classificationService->deleteClassification($classification);

            return redirect()
                    ->back()
                    ->with('success', 'Klasifikasi berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
