<?php

namespace Database\Seeders;

use App\Enums\LetterStatus;
use App\Enums\LetterType;
use App\Models\Classification;
use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classification = Classification::first() ?? Classification::create([
            'code' => '001',
            'name' => 'Tata Usaha'
        ]);

        // --- CONTOH SURAT MASUK (INCOMING) ---
        Letter::create([
            'full_number' => '001/SM/III/2026',
            'sequence_number' => 1,
            'year' => 2026,
            'type' => LetterType::INCOMING,
            'classification_code' => $classification->code,
            'file_number' => 'B.001',
            'address' => 'Dinas Pendidikan Provinsi Jawa Timur',
            'subject' => 'Undangan Rapat Koordinasi Kurikulum Merdeka',
            'reference_number' => 'REF-9921',
            'tracking_number' => 1,
            'file_path' => 'letters/seed/surat_masuk_1.pdf',
            'status' => LetterStatus::RECEIVED, // Menunggu disposisi Kepsek
        ]);

        // --- CONTOH SURAT KELUAR (OUTGOING) - STATUS DRAFT ---
        Letter::create([
            'full_number' => '002/SK/III/2026',
            'sequence_number' => 2,
            'year' => 2026,
            'type' => LetterType::OUTGOING,
            'classification_code' => $classification->code,
            'file_number' => 'B.002',
            'address' => 'Orang Tua/Wali Murid Kelas XII',
            'subject' => 'Pemberitahuan Pelaksanaan Ujian Satuan Pendidikan',
            'reference_number' => 'REF-9922',
            'tracking_number' => 2,
            'file_path' => 'letters/seed/surat_keluar_draft.pdf',
            'status' => LetterStatus::DRAFT,
        ]);

        // --- CONTOH SURAT KELUAR (OUTGOING) - SEDANG DIREVIEW ---
        $reviewingLetter = Letter::create([
            'full_number' => '003/SK/III/2026',
            'sequence_number' => 3,
            'year' => 2026,
            'type' => LetterType::OUTGOING,
            'classification_code' => $classification->code,
            'file_number' => 'B.003',
            'address' => 'PT. Industri Kreatif Sejahtera',
            'subject' => 'Permohonan Kerjasama Magang (Prakerin)',
            'reference_number' => 'REF-9923',
            'tracking_number' => 3,
            'file_path' => 'letters/seed/surat_review.pdf',
            'status' => LetterStatus::REVIEWING,
        ]);

        $reviewingLetter->letterValidate()->create([
            'waka_id' => 3, 
            'acc_katu' => false,
            'acc_waka' => false,
        ]);

        // --- CONTOH SURAT KELUAR (OUTGOING) - SUDAH VALIDASI ---
        Letter::create([
            'full_number' => '004/SK/III/2026',
            'sequence_number' => 4,
            'year' => 2026,
            'type' => LetterType::OUTGOING,
            'classification_code' => $classification->code,
            'file_number' => 'B.004',
            'address' => 'Kepala Desa Sukomulyo',
            'subject' => 'Izin Kegiatan Bakti Sosial Siswa',
            'reference_number' => 'REF-9924',
            'tracking_number' => 4,
            'file_path' => 'letters/seed/surat_siap_ttd.pdf',
            'status' => LetterStatus::VALIDATED,
        ]);
    }
}
