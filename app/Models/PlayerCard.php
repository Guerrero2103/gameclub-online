<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'birthday',
        'about',
        'profile_picture',
        'user_id',
    ];

    /**
     * Relatie met de bijhorende GamerAccount (gebruiker).
     */
    public function gamerAccount()
    {
        return $this->hasOne(PlayerCard::class, 'user_id');

    }
}
