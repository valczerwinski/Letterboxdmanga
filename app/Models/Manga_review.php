<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manga_review extends Model
{
    protected $fillable = [
        'notes',
        'Commentaire',
        'user_id',
        'manga_id',
        'volume_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
