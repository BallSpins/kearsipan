<?php

namespace App\Enums;

enum DispositionStatus: string
{
    case PENDING = 'Pending'; // status jika belum dilaksanakan
    case IN_PROGRESS = 'In Progress'; // status jika sedang dilaksanakan
    case COMPLETED = 'Completed'; // status jika sudah selesai
    case RETURNED = 'Returned'; // status jika instruksi tidak bisa dilakukan (dikembalikan ke kepsek)
}
