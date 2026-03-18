<?php

namespace App\Models;

use App\Enums\LetterStatus;
use App\Enums\LetterType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Letter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_number',
        'type',
        'status',
        'classification_code',
        'file_number',
        'address',
        'subject',
        'reference_number',
        'tracking_number',
        'file_path',
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
            'type' => LetterType::class,
            'status' => LetterStatus::class,
        ];
    }

    /**
     * Relasi ke Disposition karena Letter dapat di Disposition kan ke banyak waka
     */
    public function dispositions(): HasMany
    {
        return $this->hasMany(Disposition::class);
    }

    /**
     * Relasi ke Classification karena Letter membutuhkan Classification untuk classification_code
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'classification_code', 'code');
    }

    /**
     * Relasi ke Letter Validate karena Letter memiliki satu LetterValidate
     */
    public function letterValidate(): HasOne
    {
        return $this->hasOne(LetterValidate::class);
    }

    /**
     * Relasi ke LetterRequest karena Letter memiliki satu LetterRequest
     */
    public function letterRequest(): HasOne
    {
        return $this->hasOne(LetterRequest::class);
    }


    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }



    // --- SCOPES UNTUK SURAT KELUAR (OUTGOING) ---

    /**
     * Antrean draf yang baru dibuat atau butuh revisi.
     */
    public function scopeOutgoingDrafts(Builder $query): void
    {
        $query->where('type', LetterType::OUTGOING)
                ->where('status', LetterStatus::DRAFT);
    }

    /**
     * Antrean yang sedang menunggu validasi Ka TU / Waka.
     */
    public function scopeWaitingValidation(Builder $query): void
    {
        $query->where('type', LetterType::OUTGOING)
                ->where('status', LetterStatus::REVIEWING);
    }

    /**
     * Antrean yang sudah divalidasi dan siap cetak/TTD Kepsek.
     */
    public function scopeReadyToSign(Builder $query): void
    {
        $query->where('type', LetterType::OUTGOING)
                ->where('status', LetterStatus::VALIDATED);
    }

    // --- SCOPES UNTUK SURAT MASUK (INCOMING) ---

    /**
     * Antrean draf surat masuk (untuk fitur autosave/registrasi belum selesai).
     */
    public function scopeIncomingDrafts(Builder $query): void
    {
        $query->where('type', LetterType::INCOMING)
              ->where('status', LetterStatus::DRAFT);
    }

    /**
     * Antrean surat masuk yang baru diterima dan menunggu disposisi Kepsek.
     */
    public function scopeIncomingNew(Builder $query): void
    {
        $query->where('type', LetterType::INCOMING)
                ->where('status', LetterStatus::RECEIVED);
    }


    /**
     * Antrean surat masuk yang sudah selesai diproses/arsip.
     */
    public function scopeArchived(Builder $query): void
    {
        $query->where('status', LetterStatus::COMPLETED);
    }
}
