<?php

namespace Database\Seeders;

use App\Enums\LetterStatus;
use App\Enums\LetterType;
use App\Models\Classification;
use App\Models\Letter;
use App\Models\LetterRequest;
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

        LetterRequest::create([
            'subject' => 'Permohonan Surat Keterangan Lulus',
            'description' => 'Saya memohon surat keterangan lulus untuk keperluan pendaftaran perguruan tinggi.',
            'file_path' => 'letter_requests/permohonan_skl.pdf',
            'waka_id' => 4,
        ]);

        Letter::create([
            'full_number' => '002/SK/III/2026',
            'sequence_number' => 2,
            'year' => 2026,
            'type' => LetterType::OUTGOING,
            'classification_code' => $classification->code,
            'address' => 'Orang Tua/Wali Murid Kelas XII',
            'subject' => 'Permohonan Surat Keterangan Lulus',
            'file_path' => 'letters/seed/surat_keluar_draft.pdf',
            'status' => LetterStatus::DRAFT,
        ]);

        Letter::create([
            'full_number' => '002/SK/III/2026',
            'sequence_number' => 3,
            'year' => 2026,
            'type' => LetterType::INCOMING,
            'classification_code' => $classification->code,
            'address' => 'Orang Tua/Wali Murid Kelas XII',
            'subject' => 'Permohonan Surat Keterangan Lulus',
            'file_path' => 'letters/seed/surat_masuk_draft.pdf',
            'status' => LetterStatus::DRAFT,
        ]);

        // --- CONTOH SURAT MASUK (INCOMING) ---
        Letter::create([
            'origin_number' => '001/SM/III/2026',
            'sequence_number' => 1,
            'year' => 2026,
            'type' => LetterType::INCOMING,
            'classification_code' => $classification->code,
            'address' => 'Dinas Pendidikan Provinsi Jawa Timur',
            'subject' => 'Undangan Rapat Koordinasi Kurikulum Merdeka',
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
            'address' => 'Orang Tua/Wali Murid Kelas XII',
            'subject' => 'Pemberitahuan Pelaksanaan Ujian Satuan Pendidikan',
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
            'address' => 'PT. Industri Kreatif Sejahtera',
            'subject' => 'Permohonan Kerjasama Magang (Prakerin)',
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
            'address' => 'Kepala Desa Sukomulyo',
            'subject' => 'Izin Kegiatan Bakti Sosial Siswa',
            'file_path' => 'letters/seed/surat_siap_ttd.pdf',
            'status' => LetterStatus::VALIDATED,
        ]);

        Letter::create([
            'full_number' => '004/SK/III/2026',
            'sequence_number' => 4,
            'year' => 2026,
            'type' => LetterType::OUTGOING,
            'classification_code' => $classification->code,
            'address' => 'Kepala Desa Sukomulyo',
            'subject' => 'Izin Kegiatan Bakti Sosial Siswa',
            'file_path' => 'letters/seed/surat_siap_ttd.pdf',
            'status' => LetterStatus::COMPLETED,
        ]);
    }
}
