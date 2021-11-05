<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keyboard extends Model
{
    use HasFactory;

    protected $guarded = [
    ];

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }
}
