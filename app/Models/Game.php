<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'release_date',
        'genre',
        // Voeg hier andere game-gerelateerde velden toe
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
