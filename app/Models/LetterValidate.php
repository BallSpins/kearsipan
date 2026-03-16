<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LetterValidate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'letter_id',
        'acc_katu',
        'acc_waka',
        'note_katu',
        'note_waka',
    ];  

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        //
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'acc_katu' => 'boolean',
            'acc_waka' => 'boolean',
        ];
    }

    /**
     * Relasi ke Letter karena membutuhkan LetterValidate untuk memvalidasi dari katu dan waka
     */
    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class);
    }
}
