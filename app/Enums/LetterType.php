<?php

namespace App\Enums;

enum LetterType: string
{
    case OUTGOING = 'Outgoing'; // surat keluar
    case INCOMING = 'Incoming'; // surat masuk
}
