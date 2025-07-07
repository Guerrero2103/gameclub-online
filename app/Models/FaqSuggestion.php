<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question',
        'explanation',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 