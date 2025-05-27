<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBuzz extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'image', 'content', 'published_at'];

    public function gamerAccount()
    {
        return $this->belongsTo(GamerAccount::class);
    }

    protected $table = 'game_buzz'; // exact zoals in je migration

}
