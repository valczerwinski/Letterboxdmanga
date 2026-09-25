<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manga_review extends Model
{
    // Une review peut représenter un commentaire général ou une note de volume.
    protected $fillable = [
        'notes',
        'Commentaire',
        'user_id',
        'manga_id',
        'volume_number',
    ];

    public function user(): BelongsTo
    {
        // Une review appartient à l'utilisateur qui l'a écrite.
        return $this->belongsTo(User::class);
    }
}
