<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'entries';

    public function keyboard(): BelongsTo
    {
        return $this->belongsTo(Keyboard::class);
    }
}
