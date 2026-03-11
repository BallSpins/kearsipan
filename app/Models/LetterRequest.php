<?php

namespace App\Models;

use App\Enums\LetterRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LetterRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'subject',
        'description',
        'status',
        'file_path',
        'note_tu',
        'letter_id',
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
            'status' => LetterRequestStatus::class,
        ];
    }

    /**
     * Relasi ke LetterRequestAttachment karena dapat memiliki banyak attachment
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(LetterRequestAttachment::class);
    }

    /**
     * Relasi ke Letter karena membutuhkan LetterValidate untuk memvalidasi dari katu dan waka
     */
    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class);
    }
}
