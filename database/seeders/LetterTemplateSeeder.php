<?php

namespace Database\Seeders;

use App\Models\LetterTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LetterTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letterTemplates = [
            ['name' => 'SPPD', 'path' => 'SPPD.docx'],
            ['name' => 'Surat Balasan Cuti', 'path' => 'SURAT BALASAN CUTI.docx'],
            ['name' => 'Surat Keterangan Siswa', 'path' => 'SURAT KETERANGAN SISWA.docx'],
            ['name' => 'Surat Pemberitahuan Pengambilan Ijazah', 'path' => 'SURAT PEMBERITAHUAN PENGAMBILAN IJAZAH.docx'],
            ['name' => 'Surat Pengantar', 'path' => 'SURAT PENGANTAR.docx'],
            ['name' => 'Surat Perintah Tugas 2025 - Edited', 'path' => 'SURAT PERINTAH TUGAS 2025 - EDITED.docx'],
            ['name' => 'Surat Perintah Tugas 2025', 'path' => 'SURAT PERINTAH TUGAS 2025.docx'],
            ['name' => 'Surat Perintah Tugas Audit Internal', 'path' => 'SURAT PERINTAH TUGAS AUDIT INTERNAL.docx'],
            ['name' => 'Surat Perintah Tugas Piket 2025', 'path' => 'SURAT PERINTAH TUGAS PIKET 2025.docx'],
            ['name' => 'Surat Permohonan Kerjasama', 'path' => 'SURAT PERMOHONAN KERJASAMA.docx'],
            ['name' => 'Surat Permohonan', 'path' => 'SURAT PERMOHONAN.docx'],
            ['name' => 'Surat Undangan', 'path' => 'SURAT UNDANGAN.docx'],
        ];

        foreach ($letterTemplates as $template) {
            LetterTemplate::create([
                'name' => $template['name'],
                'slug' => Str::slug($template['name']),
                'path' => $template['path'],
            ]);
        }
    }
}
