<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function helpEntries()
    {
        return $this->hasMany(HelpEntry::class);
    }
}
