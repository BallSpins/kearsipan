<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassificationRequest;
use App\Models\Classification;
use App\Services\ClassificationService;
use Exception;
use Illuminate\Http\RedirectResponse;
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
    public function indexClassificationsView(): View
    {
        $classifications = $this->classificationService->getPaginatedClassifications();

        return view('katu.classificationIndex', compact('classifications'));
    }

    public function createClassificationView(): View
    {
        $classifications = $this->classificationService->getClassifications();

        return view('katu.classificationCreate', compact('classifications'));
    }

    /**
     * Tampilan edit klasifikasi
     */
    public function editClassificationView(Classification $classification): View
    {
        $classifications = $this->classificationService->getClassifications();

        return view('katu.classificationEdit', compact('classification', 'classifications'));
    }

    // End View function

    /**
     * Logika untuk menyimpan klasifikasi baru
     */
    public function storeClassification(ClassificationRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            $this->classificationService->createClassification($data);

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
    public function updateClassification(ClassificationRequest $request, Classification $classification): RedirectResponse
    {
        try {
            $data = $request->validated();

            $this->classificationService->updateClassification($classification, $data);

            return redirect()
                    ->route('')
                    ->with('success', 'Klasifikasi berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Logika untuk menghapus klasifikasi
     */
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
