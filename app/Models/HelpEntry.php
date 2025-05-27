<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpEntry extends Model
{
    use HasFactory;

    protected $fillable = ['help_group_id', 'question', 'answer'];

    public function helpGroup()
    {
        return $this->belongsTo(HelpGroup::class);
    }
}
