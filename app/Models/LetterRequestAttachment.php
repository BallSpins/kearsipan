<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterRequestAttachment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'letter_request_id',
        'file_path',
        'file_name',
        'file_type',
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
     * Relasi ke Letter karena Attachment adalah milik Letter (Letter memiliki banyak Attachment)
     */
    public function letterRequest(): BelongsTo 
    {
        return $this->belongsTo(LetterRequest::class);
    }
}
