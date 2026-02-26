<?php

namespace App\Enums;

enum UserRole: string
{
    case KEPALA_TU = 'Ka TU';
    case TU = 'Staf TU';
    case WAKA = 'Waka';
    case KEPALA_SEKOLAH = 'Kepala Sekolah';
}
