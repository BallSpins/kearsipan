<?php

namespace App\Enums;

enum LetterStatus: string
{
    // Status Surat Masuk
    case RECEIVED = 'Received'; // status TU mencatat surat dan mengunggah PDF
    case DISPATCHED = 'Dispatched'; // status disposisi ke waka
    
    // Status Surat Keluar
    case DRAFT = 'Draft'; // status surat jika sedang dibuat
    case REVIEWING = 'Reviewing'; // status surat jika sedang di review oleh pimpinan (kepsek)
    case VALIDATED = 'Validated'; // status surat jika sedang divalidasi pimpinan (kepsek)
    case SENT = 'Sent'; // status surat jika sudah terkirim
    
    // Status Bersama
    case COMPLETED = 'Completed';
    case REJECTED = 'Rejected';
}
