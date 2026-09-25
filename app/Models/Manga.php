<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    // Champs autorisés lors de la création ou modification en masse.
    protected $fillable = [
        'titre',
        'author',
        'description',
        'nbr_volume',
        'image',
    ];
}
