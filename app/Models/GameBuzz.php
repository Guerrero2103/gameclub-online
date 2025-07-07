<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBuzz extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'image', 'content', 'published_at'];

    protected $table = 'game_buzz'; // exact zoals in je migration

}
