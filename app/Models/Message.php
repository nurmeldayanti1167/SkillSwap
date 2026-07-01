<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['swap_id', 'sender_id', 'content'];

    public function swap(): BelongsTo
    {
        return $this->belongsTo(Swap::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}