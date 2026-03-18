<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'role',
        'password',
    ];  

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => UserRole::class,
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Disposition karena User dapat memiliki banyak Disposition
     */
    public function dispositions(): HasMany
    {
        return $this->hasMany(Disposition::class);
    }

    /**
     * Relasi ke LetterRequest karena User dapat membuat request
     * Request surat yang ditujukan ke Waka ini
     */
    public function assignedRequests(): HasMany
    {
        return $this->hasMany(LetterRequest::class, 'waka_id');
    }

    /**
     * Relasi ke LetterValidate karena User dapat memiliki banyak validasi surat
     * Surat yang harus divalidasi oleh Waka ini
     */
    public function pendingValidations(): HasMany
    {
        return $this->hasMany(LetterValidate::class, 'waka_id');
    }
}
