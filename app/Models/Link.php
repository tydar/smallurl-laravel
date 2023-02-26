<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    public function visits() : HasMany
    {
	    return $this->hasMany(Visit::class);
    }

    public function user() : BelongsTo
    {
	    return $this->belongsTo(User::class);
    }
}
