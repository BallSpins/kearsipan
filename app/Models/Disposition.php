<?php

namespace App\Models;

use App\Enums\DispositionStatus;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'letter_id',
        'receiver_role',
        'receiver_id',
        'instruction',
        'status',
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
            'receiver_role' => UserRole::class,
            'status' => DispositionStatus::class,
        ];
    }

    /**
     * Relasi balik ke Surat (Disposition dimiliki oleh Letter, karena Disposition membutuhkan data dari Letter)
     */
    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class);
    }

    /**
     * Relasi ke User (Penerima Disposisi) dimiliki oleh User, karena satu User dapat memiliki banyak Disposition
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Antrean instruksi yang belum diselesaikan oleh user yang login.
     */
    public function scopeMyPendingTasks(Builder $query): void
    {
        $query->where('receiver_id', auth()->id())
              ->where('status', '!=', DispositionStatus::COMPLETED); // Gunakan Enum jika sudah buat
    }
}
