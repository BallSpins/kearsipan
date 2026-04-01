<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'Admin';
    case KEPALA_TU = 'Ka TU';
    case TU = 'Staf TU';
    case WAKA = 'Waka';
    case KEPALA_SEKOLAH = 'Kepala Sekolah';

    public static function only(self ...$roles): string
    {
        return implode(',', array_map(fn($role) => $role->value, $roles));
    }
}
