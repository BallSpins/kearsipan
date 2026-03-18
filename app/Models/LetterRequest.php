<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'file_path',
        'letter_id',
        'waka_id',
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
            //
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
     * Relasi ke Letter karena membutuhkan referensi letter
     */
    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class);
    }

    /**
     * Relasi ke User untuk referensi ke waka terkait
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'waka_id');
    }

    /**
     * Helper untuk cek apakah sudah jadi surat resmi
     */
    public function isApproved(): bool
    {
        return !is_null($this->letter_id);
    }

    /**
     * Scope untuk filter request yang belum disentuh TU
     */
    public function scopePending(Builder $query): void
    {
        $query->whereNull('letter_id');
    }
}
