<?php

namespace App\Services;

use App\Models\Classification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ClassificationService
{
    protected $cacheKey = 'all_classifications';

    public function getPaginatedClassifications($perPage = 10)
    {
        return Classification::paginate($perPage);
    }

    public function getClassifications(): Collection
    {
        $classifications = Cache::rememberForever($this->cacheKey, function () {
            return Classification::all();
        });

        return $classifications;
    }

    public function createClassification(array $data): Classification
    {
        $classification = Classification::create($data);

        $this->refreshCache();

        return $classification;
    }

    public function updateClassification(Classification $classification, array $data): Classification
    {
        $classification->update($data);
        
        $this->refreshCache();
        
        return $classification;
    }

    public function deleteClassification(Classification $classification): bool
    {
        $deleted = $classification->delete();
        
        if ($deleted) {
            $this->refreshCache();
        }
        
        return $deleted;
    }

    /**
     * Menghapus cache agar data terbaru dapat dimuat ulang.
     */
    protected function refreshCache(): void
    {
        Cache::forget($this->cacheKey);
    }
}
