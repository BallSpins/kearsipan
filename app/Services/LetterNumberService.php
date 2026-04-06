<?php

namespace App\Services;

use App\Enums\LetterType;
use App\Models\Letter;
use Illuminate\Support\Facades\DB;

class LetterNumberService
{
    private const SCHOOL_CODE = '101.8.1.31';

    public function generateNumber(LetterType $type, string $classificationCode): array
    {
        return DB::transaction(function () use ($type, $classificationCode) {
            $year = date('Y');

            $lastLetter = Letter::where('type', $type)
                ->where('year', $year)
                ->lockForUpdate() // Race Condition
                ->latest('sequence_number')
                ->first();

            $nextNumber = $lastLetter ? $lastLetter->sequence_number + 1 : 1;
            $formatted = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                
            // {nomor} pada full number bisa diubah 
            return [
                'sequence_number' => $nextNumber,
                'year'            => $year,
                'full_number'     => "{$classificationCode}/{$formatted}/" . self::SCHOOL_CODE . "/{$year}",
                'tracking_number' => $formatted // Simpan 001, 002 ke tracking_number
            ];
        });
    }
}
