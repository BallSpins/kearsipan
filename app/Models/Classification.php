<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'parent_code',
        'name',
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
     * Relasi ke Induk (Parent)
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'parent_code', 'code');
    }

    /**
     * Relasi ke Anak (Children/Sub-klasifikasi)
     */
    public function children(): HasMany
    {
        return $this->hasMany(Classification::class, 'parent_code', 'code');
    }

    /**
     * Relasi ke tabel Letter karena Classification akan memuat banyak Letter (setiap Letter bisa membutuhkan Classification yang sama)
     */
    public function letters(): HasMany
    {
        return $this->hasMany(Letter::class, 'classification_code', 'code');
    }
}
